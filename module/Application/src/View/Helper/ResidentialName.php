<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Admin\Entity\Resident;
use Admin\Entity\Flat;


class ResidentialName extends AbstractHelper
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


    public function render($residential_id)
    {
        $name = null;
        if(!is_null($residential_id))
            $name = $this->entityManager->getRepository(Resident::class)->find($residential_id);
        if(!is_null($name))
            $name = $name->getName();

        return $name;
    }

    public function flatCount($residential_id)
    {
        if(!is_null($residential_id))
            $count = $this->entityManager->getRepository(Flat::class)->getFlatCount($residential_id);

        return $count;
    }
}