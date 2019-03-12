<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Admin\Controller;

use Admin\Entity\Commertial;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\CommertialForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class CommertialController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Commertial manager.
     * @var Admin\Service\CommertialManager
     */
    private $commertialManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager, $commertialManager)
    {
        $this->entityManager = $entityManager;
        $this->commertialManager = $commertialManager;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Commertial::class)
            ->findAllCommertial();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'commertials' => $paginator,
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
        $commertial = $this->entityManager->getRepository(Commertial::class)
            ->find($id);

        if ($commertial == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'commertial' => $commertial
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create commertial form
        $form = new CommertialForm('create', $this->entityManager, null,$resident);

        // Check if commertial has submitted the form
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

                // Add commertial.
                $commertial = $this->commertialManager->addCommertial($data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$commertial->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['plan']) && $files['plan']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['plan']['name'], $dest."/commertial".$commertial->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('commertials',
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

        $commertial = $this->entityManager->getRepository(Commertial::class)
            ->find($id);

        if ($commertial == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create commertial form
        $form = new CommertialForm('update', $this->entityManager, $commertial, $resident);

        // Check if commertial has submitted the form
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
                $this->commertialManager->updateCommertial($commertial, $data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$commertial->getResId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['plan']) && $files['plan']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['plan']['name'], $dest."/commertial".$commertial->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('commertials',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id' => $commertial->getResId(),
                'house' => $commertial->getHouse(),
                'floor'=> $commertial->getFloor(),
                'section' => $commertial->getSection(),
                'number' => $commertial->getNumber(),
                'square' => $commertial->getSquare(),
                'price' => $commertial->getPrice(),
                'height' => $commertial->getHeight(),
                'finish' => $commertial->getFinish(),
                'state' => $commertial->getState(),
            ));
        }

        return new ViewModel(array(
            'commertial' => $commertial,
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

        $commertial = $this->entityManager->getReference(Commertial::class, $id);

        // Remove it and flush
        $this->entityManager->remove($commertial);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('commertials', ['action'=>'index']);
    }

}