<?php
namespace Admin\Service;

use Admin\Entity\Flat;
use Admin\Entity\House;
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
     * House manager.
     * @var Admin\Service\HouseManager
     */
    private $houseManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager, $houseManager)
    {
        $this->entityManager = $entityManager;
        $this->houseManager = $houseManager;
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
        $house = $this->entityManager->getRepository(House::class)->findOneBy([
            'res_id' => $data['res_id'],
            'house' => $data['house']], ['id' => 'DESC']);

        if(!isset($house)){
            $info = [
                'res_id' => $data['res_id'],
                'house' => $data['house'],
                'floor' => 17,
                'section' => 1,
                'total_flat' => 1000,
                'year' => date("Y"),
                'state' => 0,
                'sell' => 1
            ];
            $house = $this->houseManager->addHouse($info);
        }
        $id = $house->getId();
        $flat->setHouse($id);
        $flat->setFloor($data['floor']);
        $flat->setSection($data['section']);
        $flat->setNumber($data['number']);
        $flat->setSize($data['size']);
        $flat->setSquare($data['square']);
        $flat->setPrice($data['price']);
        $flat->setYear($house->getYear());

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
        if($flat->getResId() != $data['res_id']) $data['ex_id'] = null;
        $flat->setExId($data['ex_id']);
        $flat->setResId($data['res_id']);
        $house = $this->entityManager->getRepository(House::class)->findOneBy([
            'res_id' => $data['res_id'],
            'house' => $data['house']], ['id' => 'DESC']);

        if(!isset($house)){
            $info = [
                'res_id' => $data['res_id'],
                'house' => $data['house'],
                'floor' => 17,
                'section' => 1,
                'total_flat' => 1000,
                'year' => date("Y"),
                'state' => 0,
                'sell' => 1
            ];
            $house = $this->houseManager->addHouse($info);
        }
        $id = $house->getId();
        $flat->setHouse($id);
        $flat->setFloor($data['floor']);
        $flat->setSection($data['section']);
        $flat->setNumber($data['number']);
        $flat->setSize($data['size']);
        $flat->setSquare($data['square']);
        $flat->setPrice($data['price']);
        $flat->setYear($house->getYear());

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

    public function changeYear($flat, $year)
    {
        $flat->setYear($year);

        $this->entityManager->flush();

        return true;
    }

}

