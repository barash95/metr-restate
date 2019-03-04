<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:37
 */

namespace Application\Controller;

use Admin\Entity\Map;
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
     * Constructor.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {
        return new ViewModel();
    }

    public function mapAction()
    {
        $query = $this->entityManager->getRepository(Map::class)
            ->findAllMap();
        $maps = $query->execute();
        return new ViewModel([
            'maps' => $maps,
        ]);
    }
}