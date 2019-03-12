<?php
namespace Admin\Service\Factory;

use Interop\Container\ContainerInterface;
use Admin\Service\MapManager;

/**
 * This is the factory class for ResidentManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class MapManagerFactory
{
    /**
     * This method creates the MapManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new MapManager($entityManager);
    }
}
