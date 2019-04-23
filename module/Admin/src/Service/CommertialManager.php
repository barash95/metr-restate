<?php
namespace Admin\Service;

use Admin\Entity\Commertial;
use Admin\Entity\House;
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
     * This method adds a new commertial.
     */
    public function addCommertial($data)
    {
        // Create new Commertial entity.
        $commertial = new Commertial();

        $commertial->setResId($data['res_id']);
        $commertial->setFloor($data['floor']);
        $commertial->setSection($data['section']);
        $commertial->setNumber($data['number']);
        $commertial->setSquare($data['square']);
        $commertial->setPrice($data['price']);
        $commertial->setHeight($data['height']);
        $commertial->setFinish($data['finish']);
        $commertial->setState($data['state']);
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
        $commertial->setHouse($id);
        $commertial->setYear($house->getYear());

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
        $commertial->setFloor($data['floor']);
        $commertial->setSection($data['section']);
        $commertial->setNumber($data['number']);
        $commertial->setSquare($data['square']);
        $commertial->setPrice($data['price']);
        $commertial->setHeight($data['height']);
        $commertial->setFinish($data['finish']);
        $commertial->setState($data['state']);
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
        $commertial->setHouse($id);
        $commertial->setYear($house->getYear());

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    public function changeYear($commertial, $year)
    {
        $commertial->setYear($year);

        $this->entityManager->flush();

        return true;
    }

}

