<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:01
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Flat;
use Admin\Entity\Mortgage;

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
     * Searh flat manager.
     * @var Flat\Service\SearchFlatManager
     */
    private $searchFlatManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
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
        $this->searchFlatManager->init("ClientListSearch");


        if ($this->getRequest()->isPost()) {
            $data = $formData = $this->params()->fromPost();
            $this->searchFlatManager->saveSearch($data);
        }else{
            $filter = $this->searchFlatManager->getSearch();

            if (count($filter)==0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
                $formData = ['size' => '', 'price_min' => '', 'price_max' => '', 'square_min' => '', 'square_max' => '', 'floor' => '', 'year' => '', 'resident' => ''];
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
        $query = $this->entityManager->getRepository(Flat::class)
            ->findAllFlat($filter);
        $count = count($query->execute());

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(6);
        $paginator->setCurrentPageNumber($page);

//        $formData = $this->checkData($formData);

        return new ViewModel([
            'data' => $formData,
            'flats' => $paginator,
            'fromQuery' => $fromQuery,
            'count' => $count
        ]);
    }

    public function viewAction()
    {
        $this->layout('layout/layout_view');

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

        $mortgages = $this->entityManager->getRepository(Mortgage::class)
            ->findAll();

        return new ViewModel([
            'flat' => $flat,
            'banks' => $mortgages
        ]);
    }

    public function favoritesAction()
    {
        $this->layout('layout/layout_view');
        if(isset($_COOKIE['favorites'])){
           $flats = $_COOKIE['favorites'];
        if ($flats)
        {
            $flats = explode(";", $flats); // array of flats
            $query = $this->entityManager->getRepository(Flat::class)
                ->findById($flats);

            /*$adapter = new DoctrineAdapter(new ORMPaginator($query, false));
            $paginator = new Paginator($adapter);
            $paginator->setDefaultItemCountPerPage(10);
            $paginator->setCurrentPageNumber($page);*/

            return new ViewModel([
                'flats' => $query
            ]);
        }}
        return new ViewModel();
    }

    public function pdfAction()
    {
        return new ViewModel();
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