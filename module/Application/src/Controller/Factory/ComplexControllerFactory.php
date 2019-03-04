<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:16
 */

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\ComplexController;

/**
 * This is the factory for ResidentController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ComplexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        // Instantiate the controller and inject dependencies
        return new ComplexController($entityManager);
    }
}