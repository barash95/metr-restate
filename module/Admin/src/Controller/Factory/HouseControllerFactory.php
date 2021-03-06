<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:16
 */

namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\HouseController;
use Admin\Service\HouseManager;
use Admin\Service\FlatManager;

/**
 * This is the factory for ResidentController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class HouseControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $houseManager = $container->get(HouseManager::class);
        $flatManager = $container->get(FlatManager::class);

        // Instantiate the controller and inject dependencies
        return new HouseController($entityManager, $houseManager, $flatManager);
    }
}