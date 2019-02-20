<?php
namespace Admin;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
            'resident' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/resident[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\ResidentController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'mapping' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/mapping[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\MapController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\ResidentController::class => Controller\Factory\ResidentControllerFactory::class,
            Controller\MapController::class => Controller\Factory\MapControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\ResidentManager::class => Service\Factory\ResidentManagerFactory::class,
            Service\MapManager::class => Service\Factory\MapManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];
