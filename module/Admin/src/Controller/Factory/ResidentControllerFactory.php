<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:16
 */

namespace Admin\Controller\Factory;

use Admin\Service\FlatManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\ResidentController;
use Admin\Service\ResidentManager;

/**
 * This is the factory for ResidentController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ResidentControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $residentManager = $container->get(ResidentManager::class);
        $flatManager = $container->get(FlatManager::class);

        // Instantiate the controller and inject dependencies
        return new ResidentController($entityManager, $residentManager, $flatManager);
    }
}