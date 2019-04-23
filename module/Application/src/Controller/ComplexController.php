<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:37
 */

namespace Application\Controller;

use Admin\Entity\Map;
use Admin\Entity\Resident;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class ComplexController extends AbstractActionController
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
        $this->layout('layout/layout_main');

        $this->searchFlatManager->init("ClientListSearch");


        if ($this->getRequest()->isPost()) {
            $data = $formData = $this->params()->fromPost();
            $this->searchFlatManager->saveSearch($data);
        }else{
            $filter = $this->searchFlatManager->getSearch();

            if (count($filter)==0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
                $formData = ['size' => '', 'price_min' => 0, 'price_max' => 4500000, 'square_min' => 0, 'square_max' => 250, 'floor' => '', 'year' => '', 'resident' => ''];
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

        $residents = $this->entityManager->getRepository(Resident::class)
            ->findAllResident()->execute();

        return new ViewModel([
            'residents' => $residents,
            'data' => $formData
        ]);
    }

    public function viewAction()
    {
        return new ViewModel();
    }

    public function mapAction()
    {
        $this->layout('layout/layout_second');
        $query = $this->entityManager->getRepository(Map::class)
            ->findAllMap();
        $maps = $query->execute();
        return new ViewModel([
            'maps' => $maps,
        ]);
    }
}