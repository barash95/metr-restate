<?php
namespace Flat\Service\Factory;

use Interop\Container\ContainerInterface;
use Flat\Service\OrderManager;

/**
 * This is the factory class for OrderManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class OrderManagerFactory
{
    /**
     * This method creates the OrderManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new OrderManager($entityManager);
    }
}
