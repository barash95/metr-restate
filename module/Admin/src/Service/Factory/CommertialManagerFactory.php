<?php
namespace Admin\Service\Factory;

use Interop\Container\ContainerInterface;
use Admin\Service\CommertialManager;
use Admin\Service\HouseManager;

/**
 * This is the factory class for commertialManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class CommertialManagerFactory
{
    /**
     * This method creates the CommertialManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $houseManager = $container->get(HouseManager::class);
                        
        return new CommertialManager($entityManager, $houseManager);
    }
}
