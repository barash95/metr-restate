<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Admin\Entity\House;


class HouseNumber extends AbstractHelper
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


    public function render($id)
    {
        $number = null;
        if(!is_null($id))
            $house = $this->entityManager->getRepository(House::class)->find($id);
        if(!is_null($house))
            $number = $house->getHouse();
        return $number;
    }
}