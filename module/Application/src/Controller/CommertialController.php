<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Application\Controller;

use Admin\Entity\Commertial;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

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
    private $searchFlatManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager, $searchFlatManager)
    {
        $this->entityManager = $entityManager;
        $this->searchFlatManager = $searchFlatManager;
    }

    public function indexAction()
    {
        $this->layout('layout/layout_second');
        $page = $this->params()->fromQuery('page', 1);
        $this->searchFlatManager->init("ClientListSearchCom");


        if ($this->getRequest()->isPost()) {
            $data = $formData = $this->params()->fromPost();
            $this->searchFlatManager->saveSearch($data);
        }else{
            $filter = $this->searchFlatManager->getSearch();

            if (count($filter)==0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
                $formData = ['price_min_com' => '', 'price_max_com' => '', 'square_min_com' => 1, 'square_max_com' => 1, 'year_com' => '', 'resident_com' => ''];
                $this->searchFlatManager->saveSearch($formData);
            }
            else
                $formData = $filter;
        }

        $filter = $this->searchFlatManager->getSearch();

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $filter = array_merge($filter, $fromQuery);
        $formData = array_merge($formData, $fromQuery);

        $query = $this->entityManager->getRepository(Commertial::class)
            ->findAllCommertial($filter, null, 0);
        $count = count($query->execute());

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
//        $formData = $this->checkData($formData);
//        return var_dump($formData);

        return new ViewModel([
            'coms' => $paginator,
            'fromQuery' => $fromQuery,
            'data' => $formData,
            'count' => $count
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

    private function checkData($data)
    {
        if(!isset($data['price_min_com'])) $data['price_min_com'] = '';
        if(!isset($data['price_max_com'])) $data['price_max_com'] = '';
        if(!isset($data['square_min_com'])) $data['square_min_com'] = '';
        if(!isset($data['square_max_com'])) $data['square_max_com'] = '';
        if(!isset($data['year_com'])) $data['year_com'] = '';
        if(!isset($data['resident_com'])) $data['resident_com'] = '';

        if(!isset($data['price_min'])) $data['price_min'] = '';
        if(!isset($data['price_max'])) $data['price_max'] = '';
        if(!isset($data['square_min'])) $data['square_min'] = '';
        if(!isset($data['square_max'])) $data['square_max'] = '';
        if(!isset($data['year'])) $data['year'] = '';
        if(!isset($data['resident'])) $data['resident'] = '';
        if(!isset($data['floor'])) $data['floor'] = '';
        if(!isset($data['size'])) $data['size'] = '';

        return $data;
    }

}