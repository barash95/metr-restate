<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Admin\Controller;

use Admin\Entity\Flat;
use Admin\Entity\House;
use Admin\Entity\Resident;
use Application\View\Helper\HouseNumber;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\FlatForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class FlatController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Flat manager.
     * @var Admin\Service\FlatManager
     */
    private $flatManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager, $flatManager)
    {
        $this->entityManager = $entityManager;
        $this->flatManager = $flatManager;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Flat::class)
            ->findAllFlat(array());
        $count = count($query->execute());

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'flats' => $paginator,
            'fromQuery' => $fromQuery,
            'count' => $count,
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
        $flat = $this->entityManager->getRepository(Flat::class)
            ->find($id);

        if ($flat == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'flat' => $flat
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new FlatForm('create', $this->entityManager, null,$resident);

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
                $data['ex_id'] = null;

                // Add flat.
                $flat = $this->flatManager->addFlat($data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$flat->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['plan']) && $files['plan']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['plan']['name'], $dest."/flat".$flat->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('flats',
                    ['action'=>'view', 'id' => $flat->getId()]);
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

        $flat = $this->entityManager->getRepository(Flat::class)
            ->find($id);

        if ($flat == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $res_id = $flat->getResId();
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new FlatForm('update', $this->entityManager, $flat, $resident);

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
                $data['ex_id'] = $flat->getExId();
                $this->flatManager->updateFlat($flat, $data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$flat->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['plan']) && $files['plan']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['plan']['name'], $dest."/flat".$flat->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('flats',
                    ['action'=>'view', 'id' => $flat->getId()]);
            }
        } else {
            $house = $this->entityManager->getRepository(House::class)->findOneBy([
                'res_id' => $flat->getResId(),
                'house' => $flat->getHouse()], ['id' => 'DESC']);

            $form->setData(array(
                'res_id' => $flat->getResId(),
                'ex_id' => $flat->getExId(),
                'house' => $house,
                'floor'=> $flat->getFloor(),
                'section' => $flat->getSection(),
                'number' => $flat->getNumber(),
                'size' => $flat->getSize(),
                'square' => $flat->getSquare(),
                'price' => $flat->getPrice()
            ));
        }

        return new ViewModel(array(
            'flat' => $flat,
            'form' => $form
        ));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $flat = $this->entityManager->getReference(Flat::class, $id);

        // Remove it and flush
        $this->entityManager->remove($flat);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('flats', ['action'=>'index']);
    }

}