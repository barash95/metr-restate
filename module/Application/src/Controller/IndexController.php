<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Admin\Entity\Resident;
use Admin\Entity\Flat;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
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
        $flats = $this->entityManager->getRepository(Flat::class)->findBestFlats(15);

        return new ViewModel([
            'residents' => $residents,
            'flats' => $flats,
            'data' => $formData
        ]);
    }

    public function aboutAction()
    {
        $this->layout('layout/layout_second');
        return new ViewModel();
    }

    public function contactsAction()
    {
        $this->layout('layout/layout_second');
        return new ViewModel();
    }

    public function mortgageAction()
    {
        return new ViewModel();
    }

}
