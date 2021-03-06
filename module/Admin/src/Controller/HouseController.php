<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Admin\Controller;

use Admin\Entity\Commertial;
use Admin\Entity\House;
use Admin\Entity\Resident;
use Admin\Entity\Flat;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\HouseForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class HouseController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * House manager.
     * @var Admin\Service\HouseManager
     */
    private $houseManager;

    private $flatManager;
    /**
     * Constructor.
     */
    public function __construct($entityManager, $houseManager, $flatManager)
    {
        $this->entityManager = $entityManager;
        $this->houseManager = $houseManager;
        $this->flatManager = $flatManager;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(House::class)
            ->findAllHouse();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'housing' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function viewAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Find a resident with such ID.
        $house = $this->entityManager->getRepository(House::class)
            ->find($id);

        if ($house == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'house' => $house
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new HouseForm('create', $this->entityManager, null,$resident);

        // Check if flat has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Add house.
                $house = $this->houseManager->addHouse($data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$house->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest."/house".$house->getHouse().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('housing',
                    ['action'=>'index']);
            }
        } else {
            $data['res_id'] = $res_id;

            $form->setData($data);
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $house = $this->entityManager->getRepository(House::class)
            ->find($id);

        if ($house == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create house form
        $form = new HouseForm('update', $this->entityManager, $house, $resident);

        // Check if house has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $this->houseManager->updateHouse($house, $data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$house->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest."/house".$house->getHouse().".jpeg");
                }

                $flats = $this->entityManager->getRepository(Flat::class)->findBy([
                    'res_id' => $data['res_id'],
                    'house' => $house->getId()], ['id' => 'DESC']);
                foreach ($flats as $flat)
                    $this->flatManager->changeYear($flat, $data['year']);

                $commertials = $this->entityManager->getRepository(Commertial::class)->findBy([
                    'res_id' => $data['res_id'],
                    'house' => $house->getId()], ['id' => 'DESC']);
                foreach ($commertials as $com)
                    $this->flatManager->changeYear($com, $data['year']);

                // Redirect to "view" page
                return $this->redirect()->toRoute('housing',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id'=>$house->getResId(),
                'house'=>$house->getHouse(),
                'floor'=>$house->getFloor(),
                'section'=>$house->getSection(),
                'total_flat'=>$house->getTotalFlat(),
                'year'=>$house->getYear(),
                'state'=>$house->getState(),
                'sell'=>$house->getSell(),
            ));
        }

        return new ViewModel(array(
            'house' => $house,
            'form' => $form
        ));
    }

    public function deleteAction()
    {

        $this->layout('layout/empty');
        $viewModel = null;

        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();
            $data = $request->getPost()->toArray();
            $id = $data['id'];

            $house = $this->entityManager->getRepository(House::class)->find($id);

            // Remove it and flush
            $this->entityManager->remove($house);
            $this->entityManager->flush();

            $viewModel = new ViewModel(array());
        }

        $viewModel->setTerminal(true);

        return $viewModel;

    }

}