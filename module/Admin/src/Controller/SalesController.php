<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Admin\Controller;

use Admin\Entity\Sales;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\SalesForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class SalesController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Sales manager.
     * @var Admin\Service\SalesManager
     */
    private $salesManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager, $salesManager)
    {
        $this->entityManager = $entityManager;
        $this->salesManager = $salesManager;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Sales::class)
            ->findAllSales();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'sales' => $paginator,
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
        $sales = $this->entityManager->getRepository(Sales::class)
            ->find($id);

        if ($sales == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'sales' => $sales
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new SalesForm('create', $this->entityManager, null,$resident);

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

                // Add sales.
                $sales = $this->salesManager->addSales($data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/sales/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest.$sales->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('asales',
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

        $sales = $this->entityManager->getRepository(Sales::class)
            ->find($id);

        if ($sales == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create sales form
        $form = new SalesForm('update', $this->entityManager, $sales, $resident);

        // Check if sales has submitted the form
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
                $this->salesManager->updateSales($sales, $data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/sales/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest.$sales->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('asales',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id'=>$sales->getResId(),
                'tittle'=>$sales->getTittle(),
                'description'=>$sales->getDescription(),
                'date'=>$sales->getDate(),
            ));
        }

        return new ViewModel(array(
            'sales' => $sales,
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

        $sales = $this->entityManager->getReference(Sales::class, $id);

        // Remove it and flush
        $this->entityManager->remove($sales);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('asales', ['action'=>'index']);
    }

}