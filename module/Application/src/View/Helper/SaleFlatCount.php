<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Admin\Entity\House;
use Admin\Entity\Flat;


class SaleFlatCount extends AbstractHelper
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


    public function render($residential_id, $house)
    {
        $houseCount = $this->entityManager->getRepository(House::class)->getFlatInHouse($residential_id, $house);
        $flatCount = $this->entityManager->getRepository(Flat::class)->getFlatInHouse($residential_id, $house);
        $count = $houseCount - $flatCount;
        if($count < 0) return '';
        return $count;
    }
}