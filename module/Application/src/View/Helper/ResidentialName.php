<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Admin\Entity\Resident;


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
        if(!is_null($residential_id))
        return $this->entityManager->getRepository(Resident::class)->getNameById($residential_id);
    }
}