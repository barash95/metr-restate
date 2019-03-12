<?php
namespace Admin\Service;

use Admin\Entity\Video;
/**
 * This service is responsible for adding/editing video
 */
class VideoManager
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
     * This method adds a new video.
     */
    public function addVideo($data)
    {
        // Create new video entity.
        $video = new Video();

        $video->setResId($data['res_id']);
        $video->setTittle($data['tittle']);
        $video->setLink($data['link']);
        $video->setDate($data['date']);

        // Add the entity to the entity manager.
        $this->entityManager->persist($video);

        // Apply changes to database.
        $this->entityManager->flush();

        return $video;
    }

    /**
     * This method updates data of an existing flat.
     */
    public function updateVideo($video, $data)
    {

        $video->setResId($data['res_id']);
        $video->setTittle($data['tittle']);
        $video->setLink($data['link']);
        $video->setDate($data['date']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

}

