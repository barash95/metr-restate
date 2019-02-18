<?php
namespace Flat\Service\Factory;

use Interop\Container\ContainerInterface;
use Flat\Service\VideoManager;

/**
 * This is the factory class for VideoManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class GalleryManagerFactory
{
    /**
     * This method creates the VideoManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new VideoManager($entityManager);
    }
}
