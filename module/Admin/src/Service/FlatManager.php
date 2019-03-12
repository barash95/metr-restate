<?php
namespace Admin\Service;

use Admin\Entity\Flat;
/**
 * This service is responsible for adding/editing flat
 */
class FlatManager
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
     * This method adds a new flat.
     */
    public function addFlat($data)
    {
        // Create new Flat entity.
        $flat = new Flat();

        $flat->setExId($data['ex_id']);
        $flat->setResId($data['res_id']);
        $flat->setHouse($data['house']);
        $flat->setFloor($data['floor']);
        $flat->setSection($data['section']);
        $flat->setNumber($data['number']);
        $flat->setSize($data['size']);
        $flat->setSquare($data['square']);
        $flat->setPrice($data['price']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($flat);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $flat;
    }
    
    /**
     * This method updates data of an existing flat.
     */
    public function updateFlat($flat, $data)
    {

        $flat->setExId($data['ex_id']);
        $flat->setResId($data['res_id']);
        $flat->setHouse($data['house']);
        $flat->setFloor($data['floor']);
        $flat->setSection($data['section']);
        $flat->setNumber($data['number']);
        $flat->setSize($data['size']);
        $flat->setSquare($data['square']);
        $flat->setPrice($data['price']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    public function addOrUpdateFlat($data)
    {
        $flat = $this->entityManager->getRepository(Flat::class)->findByExId($data['res_id'],$data['ex_id']);
        if(count($flat)>0) $this->updateFlat($flat[0], $data);
        else $flat = $this->addFlat($data);
        return $flat;
    }

}

