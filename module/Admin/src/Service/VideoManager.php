<?php
namespace Admin\Service;

use Admin\Entity\Video;

/**
 * This service is responsible for all gallery management
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

  public function addVideo($data){
    $video = new Video();

    $video->setTittle($data['tittle']);
    $video->setResId($data['res_id']);
    $video->setDate($data['upload_date']);
    $video->setLink($data['link']);

    // Add the entity to the entity manager.
    $this->entityManager->persist($video);

    // Apply changes to database.
    $this->entityManager->flush();

    return $video;
  }

  public function removeFile($id){
    $videos = $this->entityManager->getReference(Gallery::class, $id);

    if ($videos->getFileType()==0) {
      $video = ROOT_PATH . "/public" . $videos->getFilePath();
      unlink($video);
    }

    $this->entityManager->remove($videos);
    $this->entityManager->flush();
  }
}

