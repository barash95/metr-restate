<?php
namespace Admin\Service;

use Admin\Entity\Commertial;
/**
 * This service is responsible for adding/editing commertial
 */
class CommertialManager
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
     * This method adds a new commertial.
     */
    public function addCommertial($data)
    {
        // Create new Commertial entity.
        $commertial = new Commertial();

        $commertial->setResId($data['res_id']);
        $commertial->setHouse($data['house']);
        $commertial->setFloor($data['floor']);
        $commertial->setSection($data['section']);
        $commertial->setNumber($data['number']);
        $commertial->setSquare($data['square']);
        $commertial->setPrice($data['price']);
        $commertial->setHeight($data['height']);
        $commertial->setFinish($data['finish']);
        $commertial->setState($data['state']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($commertial);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $commertial;
    }
    
    /**
     * This method updates data of an existing commertial.
     */
    public function updateCommertial($commertial, $data)
    {
        $commertial->setResId($data['res_id']);
        $commertial->setHouse($data['house']);
        $commertial->setFloor($data['floor']);
        $commertial->setSection($data['section']);
        $commertial->setNumber($data['number']);
        $commertial->setSquare($data['square']);
        $commertial->setPrice($data['price']);
        $commertial->setHeight($data['height']);
        $commertial->setFinish($data['finish']);
        $commertial->setState($data['state']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

