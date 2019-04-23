<?php
namespace Admin\Service\Factory;

use Interop\Container\ContainerInterface;
use Admin\Service\SearchFlatManager;
use Zend\Session\SessionManager;

/**
 * This is the factory class for SearchFlatManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class SearchFlatManagerFactory
{
    /**
     * This method creates the SearchFlatManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $sessionManager = $container->get(SessionManager::class);
        return new SearchFlatManager($sessionManager);
    }
}
