<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Entity\Order;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class OrderController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Order manager.
     * @var Admin\Service\OrderManager
     */
    private $orderManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $orderManager)
    {
        $this->entityManager = $entityManager;
        $this->orderManager = $orderManager;
    }


    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);
        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Order::class)
            ->findAllOrder();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        return new ViewModel([
            'orders' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function addAction()
    {
        $this->layout('layout/empty');
        $viewModel = null;

        $log_file = "/var/www/html/metr/metr-restate/logs/log.log";

        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();
            $data = $request->getPost()->toArray();
            $log =  $data['name'] ." ".$data['phone'] ;

//            file_put_contents($log_file, "Date: ".date("Y-m-d H:i:s").", data: $log\n", FILE_APPEND);
            $order = $this->orderManager->addOrder($data);

            $viewModel = new ViewModel(array(
                'order_id' => $order->getId()
            ));
        }else{
            $viewModel = new ViewModel(array(
                'order_id' => ''
            ));
        }

        $viewModel->setTerminal(true);

        return $viewModel;
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {
        $this->layout('layout/empty');
        $viewModel = null;

        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();
            $data = $request->getPost()->toArray();
            $id = $data['id'];

            $order = $this->entityManager->getRepository(Order::class)->find($id);

            // Remove it and flush
            $this->entityManager->remove($order);
            $this->entityManager->flush();

            $viewModel = new ViewModel(array());
        }

        $viewModel->setTerminal(true);

        return $viewModel;
    }

}