<?php
namespace Admin\Service;

use Admin\Entity\Mortgage;
/**
 * This service is responsible for adding/editing mortgage
 */
class MortgageManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new mortgage.
     */
    public function addMortgage($data)
    {
        // Create new mortgage entity.
        $mortgage = new Mortgage();

        $mortgage->setName($data['name']);
        $mortgage->setPercent($data['percent']);
        $mortgage->setYear($data['year']);
        $mortgage->setMoney($data['money']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($mortgage);

        // Apply changes to database.
        $this->entityManager->flush();

        return $mortgage;
    }

    /**
     * This method updates data of an existing flat.
     */
    public function updateMortgage($mortgage, $data)
    {
        $mortgage->setName($data['name']);
        $mortgage->setPercent($data['percent']);
        $mortgage->setYear($data['year']);
        $mortgage->setMoney($data['money']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

