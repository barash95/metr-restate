<?php
namespace Admin;

use DoctrineModule\Validator\Service\Exception\ServiceCreationException;
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
            'housing' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/housing[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\HouseController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'video' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/video[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\VideoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'mortgage' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/mortgage[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\MortgageController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'anews' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/anews[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\NewsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'flats' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/flats[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\FlatController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'commertials' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/commertials[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\CommertialController::class,
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
            Controller\HouseController::class => Controller\Factory\HouseControllerFactory::class,
            Controller\VideoController::class => Controller\Factory\VideoControllerFactory::class,
            Controller\MortgageController::class => Controller\Factory\MortgageControllerFactory::class,
            Controller\NewsController::class => Controller\Factory\NewsControllerFactory::class,
            Controller\FlatController::class => Controller\Factory\FlatControllerFactory::class,
            Controller\CommertialController::class => Controller\Factory\CommertialControllerFactory::class,
        ],
    ],
    'access_filter' => [
        'controllers' => [
            Controller\IndexController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index"], 'allow' => '@']
            ],
            Controller\ResidentController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", "add", "view", "delete", "parse"], 'allow' => '@']
            ],
            Controller\HouseController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'view', 'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\FlatController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'view', 'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\CommertialController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'view', 'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\MapController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\MortgageController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\NewsController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'view' ,'edit', 'delete', 'add'], 'allow' => '@']
            ],
            Controller\VideoController::class => [
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ["index", 'edit', 'delete', 'add'], 'allow' => '@']
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\ResidentManager::class => Service\Factory\ResidentManagerFactory::class,
            Service\MapManager::class => Service\Factory\MapManagerFactory::class,
            Service\FlatManager::class => Service\Factory\FlatManagerFactory::class,
            Service\HouseManager::class => Service\Factory\HouseManagerFactory::class,
            Service\VideoManager::class => Service\Factory\VideoManagerFactory::class,
            Service\MortgageManager::class => Service\Factory\MortgageManagerFactory::class,
            Service\NewsManager::class => Service\Factory\NewsManagerFactory::class,
            Service\CommertialManager::class => Service\Factory\CommertialManagerFactory::class,
            Service\SearchFlatManager::class => Service\Factory\SearchFlatManagerFactory::class,
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
