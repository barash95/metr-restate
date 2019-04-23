<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Admin\Entity\Resident;
use Admin\Entity\House;


class FilterData extends AbstractHelper
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


    public function getResident()
    {
        $residents = $this->entityManager->getRepository(Resident::class)->getResidentList();

        return $residents;
    }

    public function getYear()
    {
        $year = $this->entityManager->getRepository(House::class)->getYearList();

        return $year;
    }
}