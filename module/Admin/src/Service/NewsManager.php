<?php
namespace Admin\Service;

use Admin\Entity\News;

/**
 * The NewManager service is responsible for news management
 */
class NewsManager
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
   * This method adds news
   */
  public function addNews($data)
  {
    $news = new News();

    $news->setTittle($data['tittle']);
    $news->setDescription($data['description']);
    $news->setDate($data['date']);
    $news->setResId($data['res_id']);

    // Add the entity to the entity manager.
    $this->entityManager->persist($news);

    // Apply changes to database.
    $this->entityManager->flush();

    return $news;
  }

  /**
   * This method updates news
   */
  public function updateNews($news, $data)
  {
      $news->setTittle($data['tittle']);
      $news->setDescription($data['description']);
      $news->setDate($data['date']);
      $news->setResId($data['res_id']);

    // Apply changes to database.
    $this->entityManager->flush();

    return true;
  }
}