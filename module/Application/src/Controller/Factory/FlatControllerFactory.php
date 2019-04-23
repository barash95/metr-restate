<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\FlatController;
use Admin\Service\SearchFlatManager;

/**
 * This is the factory for FlatController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class FlatControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $searchFlatManager = $container->get(SearchFlatManager::class);
        
        // Instantiate the controller and inject dependencies
        return new FlatController($entityManager, $searchFlatManager);
    }
}