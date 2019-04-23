<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'about' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/about',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'about',
                    ],
                ],
            ],
            'contacts' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/contacts',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'contacts',
                    ],
                ],
            ],
            'mortgage' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/mortgage',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'mortgage',
                    ],
                ],
            ],
            'news' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/news[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\NewsController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'flat' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/flat[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\FlatController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'commertial' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/commertial[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\CommertialController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'favorites' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/favorites',
                    'defaults' => [
                        'controller' => Controller\FlatController::class,
                        'action'     => 'favorites',
                    ],
                ],
            ],
            'complex' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/complex[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\ComplexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'map' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/map',
                    'defaults' => [
                        'controller' => Controller\ComplexController::class,
                        'action'     => 'map',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\ComplexController::class => Controller\Factory\ComplexControllerFactory::class,
            Controller\FlatController::class => Controller\Factory\FlatControllerFactory::class,
            Controller\CommertialController::class => Controller\Factory\CommertialControllerFactory::class,
            Controller\NewsController::class => InvokableFactory::class,
        ],
    ],
    'access_filter' => [
        'options' => [
            'mode' => 'permissive',
        ]
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
            View\Helper\FormatPrice::class => InvokableFactory::class,
            View\Helper\ResidentialName::class => View\Helper\Factory\ResidentialNameFactory::class,
            View\Helper\SaleFlatCount::class => View\Helper\Factory\SaleFlatCountFactory::class,
            View\Helper\HouseNumber::class => View\Helper\Factory\HouseNumberFactory::class,
            View\Helper\FilterData::class => View\Helper\Factory\FilterDataFactory::class,
            View\Helper\Current::class => InvokableFactory::class,
            View\Helper\ActiveMenu::class => InvokableFactory::class,
        ],
        'aliases' => [
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
            'residentialName' => View\Helper\ResidentialName::class,
            'saleFlatCount' => View\Helper\SaleFlatCount::class,
            'houseNumber' => View\Helper\HouseNumber::class,
            'formatPrice' => View\Helper\FormatPrice::class,
            'filterData' => View\Helper\FilterData::class,
            'current' => View\Helper\Current::class,
            'activeMenu' => View\Helper\ActiveMenu::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/layout_main'           => __DIR__ . '/../view/layout/layout_main.phtml',
            'layout/layout_second'           => __DIR__ . '/../view/layout/layout_second.phtml',
            'layout/layout_view'           => __DIR__ . '/../view/layout/layout_view.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
