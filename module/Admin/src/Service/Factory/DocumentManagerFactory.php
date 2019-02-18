<?php
namespace Flat\Service\Factory;

use Interop\Container\ContainerInterface;
use Flat\Service\DocumentManager;

/**
 * This is the factory class for DocumentManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class DocumentManagerFactory
{
    /**
     * This method creates the DocumentManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new DocumentManager($entityManager);
    }
}
