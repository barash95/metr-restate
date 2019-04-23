<?php
namespace Admin\Service;

use Admin\Entity\House;
use Admin\Entity\Flat;
/**
 * This service is responsible for adding/editing rouse
 */
class HouseManager
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
     * This method adds a new rouse.
     */
    public function addHouse($data)
    {
        // Create new House entity.
        $house = new House();

        $house->setResId($data['res_id']);
        $house->setHouse($data['house']);
        $house->setFloor($data['floor']);
        $house->setSection($data['section']);
        $house->setTotalFlat($data['total_flat']);
        $house->setYear($data['year']);
        $house->setState($data['state']);
        $house->setSell($data['sell']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($house);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $house;
    }
    
    /**
     * This method updates data of an existing flat.
     */
    public function updateHouse($house, $data)
    {
        $house->setResId($data['res_id']);
        $house->setHouse($data['house']);
        $house->setFloor($data['floor']);
        $house->setSection($data['section']);
        $house->setTotalFlat($data['total_flat']);
        $house->setYear($data['year']);
        $house->setState($data['state']);
        $house->setSell($data['sell']);


        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

