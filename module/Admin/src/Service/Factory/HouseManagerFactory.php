<?php
namespace Admin\Service\Factory;

use Interop\Container\ContainerInterface;
use Admin\Service\HouseManager;

/**
 * This is the factory class for HouseManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class HouseManagerFactory
{
    /**
     * This method creates the FlatManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new HouseManager($entityManager);
    }
}
