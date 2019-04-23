<?php
namespace User\Service;

use Client\Entity\Client;
use Flat\Entity\Flat;
use Client\Entity\ClientHistory;
use User\Entity\Event;
use User\Entity\User;

/**
 * This service is responsible for adding/editing events
 */
class EventManager
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
   * This method adds a new event.
   */
  public function addEvent($data, $user)
  {
    // Create new Event entity.
    $event = new Event();
    $event->setType($data['type']);
    $event->setDescription($data['description']);
    $event->setEventTime($data['event_time']);
    $event->setStatus(0);

    if ($data['client']!='') {
      $client = $this->entityManager->getReference(Client::class, $data['client']);
      $event->setClient($client);

      $history = new ClientHistory();
      $history->setClient($client);
      $history->setType($event->getTypeAsString());
      $history->setDescription($event->getDescription());
      $history->setEventTime(date('Y-m-d H:i:s'));

      $this->entityManager->persist($history);
    }else
    {
      $event->setClient(null);
    }

    if ($data['flat']!='' && $data['flat']!='-1' ) {
      $flat = $this->entityManager->getReference(Flat::class, $data['flat']);
      $event->setFlat($flat);
      $this->entityManager->persist($history);
    }else
    {
      $event->setFlat(null);
    }

    $event->setUser($user);
    $this->entityManager->persist($event);

    // Apply changes to database.
    $this->entityManager->flush();

    return $event;
  }

  /**
   * This method updates data of an existing event.
   */
  public function updateEvent($event, $data)
  {
    $event->setType($data['type']);
    $event->setDescription($data['description']);
    $event->setEventTime($data['event_time']);

    // Apply changes to database.
    $this->entityManager->flush();

    return true;
  }
}

