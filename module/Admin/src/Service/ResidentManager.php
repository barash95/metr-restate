<?php
namespace Admin\Service;

use Admin\Entity\Resident;
/**
 * This service is responsible for adding/editing resident
 */
class ResidentManager
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
     * This method adds a new resident.
     */
    public function addResident($data)
    {
        // Create new Resident entity.
        $resident = new Resident();

        $resident->setName($data['name']);
        $resident->setTittle($data['tittle']);
        $resident->setDescription($data['description']);
        $resident->setTittle1($data['tittle1']);
        $resident->setDescription1($data['description1']);
        $resident->setTittle2($data['tittle2']);
        $resident->setDescription2($data['description2']);
        $resident->setTittle3($data['tittle3']);
        $resident->setDescription3($data['description3']);
        $resident->setMetro($data['metro']);
        $resident->setAddress($data['address']);
        $resident->setHousing($data['housing']);
        $resident->setTotalFlat($data['total_flat']);
        $resident->setState($data['state']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($resident);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $resident;
    }
    
    /**
     * This method updates data of an existing flat.
     */
    public function updateResident($resident, $data)
    {
        $resident->setName($data['name']);
        $resident->setTittle($data['tittle']);
        $resident->setDescription($data['description']);
        $resident->setTittle1($data['tittle1']);
        $resident->setDescription1($data['description1']);
        $resident->setTittle2($data['tittle2']);
        $resident->setDescription2($data['description2']);
        $resident->setTittle3($data['tittle3']);
        $resident->setDescription3($data['description3']);
        $resident->setMetro($data['metro']);
        $resident->setAddress($data['address']);
        $resident->setHousing($data['housing']);
        $resident->setTotalFlat($data['total_flat']);
        $resident->setState($data['state']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

