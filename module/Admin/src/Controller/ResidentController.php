<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\ResidentForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ResidentController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Flat manager.
     * @var Admin\Service\ResidentManager
     */
    private $residentManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $residentManager)
    {
        $this->entityManager = $entityManager;
        $this->residentManager = $residentManager;
    }


    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $query = $this->entityManager->getRepository(Resident::class)
            ->findAllResident();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'flats' => $paginator
        ]);
    }

    public function addAction()
    {

        // Create flat form
        $form = new ResidentForm('create', $this->entityManager);

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

                // Add flat.
                $resident = $this->residentManager->addResident($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('resident',
                    ['action'=>'view', 'id'=>$resident->getId()]);
            }
        }

        return new ViewModel([
            'form' => $form
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
        $resident = $this->entityManager->getRepository(Resident::class)
            ->find($id);

        if ($resident == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'resident' => $resident
        ]);
    }

    public function editAction()
    {

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $resident = $this->entityManager->getRepository(Resident::class)
            ->find($id);

        if ($resident == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create resident form
        $form = new ResidentForm('update', $this->entityManager, $resident);

        // Check if resident has submitted the form
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

                // Update the flat.
                $this->residentManager->updateResident($resident, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('resident',
                    ['action'=>'view', 'id'=>$resident->getId()]);
            }
        } else {

            $form->setData(array(
                'name'=>$resident->getName(),
                'tittle'=>$resident->getTittle(),
                'description'=>$resident->getDescription(),
                'metro'=>$resident->getMetro(),
                'housing'=>$resident->getHousing(),
                'address'=>$resident->getAddress(),
                'total_flat'=>$resident->getTotalFlat(),
                'state'=>$resident->getState(),
                'stateString'=>$resident->getStateAsString(),
            ));
        }

        return new ViewModel(array(
            'flat' => $resident,
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

        $resident = $this->entityManager->getReference(Resident::class, $id);

        // Remove it and flush
        $this->entityManager->delete($resident);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('resident', ['action'=>'index']);
    }

}