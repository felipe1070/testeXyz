<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Enquete;

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
					'type' => 'Literal',
					'options' => array(
						'route'=> '/enquete',
						'defaults'=> array(
							'__NAMESPACE__' => 'Enquete\Controller',
							'controller' => 'Index',
							'action' => 'index'
						)	
							
					),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'default' => array(
            						'type' => 'Segment',
            						'options' => array(
            								'route' => '/[:controller[/:action[/:id]]]',
            								'constraints' => array(
            										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            										'id' => '\d+'
            								),
            								'defaults' => array(
            										'__NAMESPACE__' => 'Enquete\Controller',
            										'controller' => 'index'
            								)
            						)
            				),
            			)
				),
        		
        		'auth' => array(
        				'type' => 'Literal',
        				'options' => array(
        						'route'=> '/auth',
        						'defaults'=> array(
        								'__NAMESPACE__' => 'Enquete\Controller',
        								'controller' => 'Auth',
        								'action' => 'index'
        						)
        							
        				)
        		),
        		
        		'logout' => array(
        				'type' => 'Literal',
        				'options' => array(
        						'route' => '/logout',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Enquete\Controller',
        								'controller' => 'Auth',
        								'action' => 'logout',
        								
        		
        						),
        				),
        		),
            
        ),
    ),
    
    
    'controllers' => array(
        'invokables' => array(
            'Enquete\Controller\Index' => "Enquete\Controller\IndexController",
        	'Enquete\Controller\Auth' => "Enquete\Controller\AuthController"
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'enquete/index/index' => __DIR__ . '/../view/enquete/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
		
		// Placeholder for console routes
		'console' => array(
				'router' => array(
						'routes' => array(
						),
				),
		),
		
		
	'doctrine' => array(
			'driver' => array(
					__NAMESPACE__ . '_driver' => array(
							'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
							'cache' => 'array',
							'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
					),
					'orm_default' => array(
							'drivers' => array(
									__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
							),
					),
			),
	),
    
);
