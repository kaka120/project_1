<?php
namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [//home routing
                'type' => Literal::class,
                 'options' => [
                    'route'    => '/index/home',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
             'about' => [//about routing
                'type' => Literal::class,
                'options' => [
                    'route'    => '/index/about',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'about',
                    ],
                ],
            ],
         
             'contact' => [//contact routing
                'type' => Literal::class,
                'options' => [
                    'route'    => '/index/contact',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'contact',
                    ],
                ],
            ],
            'process' => [//process routing
                'type' => Literal::class,
                'options' => [
                    'route'    => '/index/process',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'process',
                    ],
                ],
            ],
            'index1' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/index/index1',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index1',
                    ],
                ],
            ],
             'add' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/index/add',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'add',
                    ],
                ],
            ],
            'edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/index/edit[/:id]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'edit',
                    ],
                    'constraints'=>         
                    [
                      'id'         => '[0-9]\d*',  
                    ],
                ],
            ],
            'del' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/index/del[/:id]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'delete',
                        
                    ],
                    'constraints'=>       
                    [
                      'id'         => '[0-9]\d*',  
                    ],
                ],
            ],
            'data' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/data[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => '[a-zA-Z][a-zA-Z0-9]*',
                        
                    ],
                    'constraints'=> 
                    [
                      'id'         => '[0-9]\d*',  
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
