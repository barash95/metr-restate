<?php
namespace Admin\Service;

use Admin\Entity\Map;
/**
 * This service is responsible for adding/editing map
 */
class MapManager
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
     * This method adds a new map.
     */
    public function addMap($data)
    {
        // Create new map entity.
        $map = new Map();

        $map->setResId($data['res_id']);
        $map->setX($data['x_pos']);
        $map->setY($data['y_pos']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($map);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $map;
    }
    
    /**
     * This method updates data of an existing flat.
     */
    public function updateMap($map, $data)
    {

        $map->setResId($data['res_id']);
        $map->setX($data['x_pos']);
        $map->setY($data['y_pos']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

