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
use Zend\Mvc\MvcEvent;

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

    public function onDispatch(MvcEvent $e)
    {
        // Вызываем метод базового класса onDispatch() и получаем ответ
        $response = parent::onDispatch($e);

        $ajax = $this->params()->fromQuery('ajax', false);

        if (!$ajax) {
            $this->layout('layout/layout_second');
        }
        if ($ajax) {
            $this->layout('layout/mini_layout');
        }

        // Возвращаем ответ
        return $response;
    }

    public function indexAction()
    {
        $this->searchFlatManager->init("ClientListSearch");

        if ($this->getRequest()->isPost()) {
            $data = $formData = $this->params()->fromPost();
            $this->searchFlatManager->saveSearch($data);
        } else {
            $filter = $this->searchFlatManager->getSearch();

            if (count($filter) == 0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
                $formData = ['size' => '', 'price_min' => '', 'price_max' => '', 'square_min' => '', 'square_max' => '', 'floor' => '', 'year' => '', 'resident' => '', 'region' => '', 'metro' => ''];
                $this->searchFlatManager->saveSearch($formData);
            }
            else {
                $formData = $filter;
                $this->searchFlatManager->saveSearch($formData);
            }
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
        return new ViewModel();
    }

    public function contactsAction()
    {
        return new ViewModel();
    }

    public function mortgageAction()
    {
        return new ViewModel();
    }

}
