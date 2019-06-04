<?php

namespace Admin\Service;

use Admin\Entity\Sales;

/**
 * The NewManager service is responsible for sales management
 */
class SalesManager
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
     * This method adds sales
     */
    public function addSales($data)
    {
        $sales = new Sales();

        $sales->setTitle($data['title']);
        $sales->setSubtitle($data['subtitle']);
        $sales->setDescription($data['description']);
        $sales->setDiscount($data['discount']);
        $sales->setTime($data['time']);
        $sales->setFilter($data['filter']);
        $sales->setResId($data['res_id']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($sales);

        // Apply changes to database.
        $this->entityManager->flush();

        return $sales;
    }

    /**
     * This method updates sales
     */
    public function updateSales($sales, $data)
    {
        $sales->setTitle($data['title']);
        $sales->setSubtitle($data['subtitle']);
        $sales->setDescription($data['description']);
        $sales->setDiscount($data['discount']);
        $sales->setTime($data['time']);
        $sales->setFilter($data['filter']);
        $sales->setResId($data['res_id']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
}