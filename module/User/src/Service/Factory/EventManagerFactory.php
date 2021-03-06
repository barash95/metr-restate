<?php
namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
use User\Service\EventManager;

/**
 * This is the factory class for EventManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class EventManagerFactory
{
  /**
   * This method creates the EventManager service and returns its instance.
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
  {
    $entityManager = $container->get('doctrine.entitymanager.orm_default');

    return new EventManager($entityManager);
  }
}
