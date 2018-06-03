<?php

return array(

'router' => array(

'routes' => array(

'hello' => array(

'type' => 'Literal',

'options' => array(

'route' => '/hello',

'defaults' => array(

'controller' => 'Hello\Controller\Hello',

'action' => 'index',

),

),

'may_terminate' => true,

'child_routes' => array(

'default' => array(

'type' => 'Segment',

'options' => array(

'route' => '/[:action]',

'constraints' => array(

'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

),

),

),

),

),

),

),

'controllers' => array(

'invokables' => array(

'Hello\Controller\Hello' => 'Hello\Controller\HelloController',

),

),

'view_manager' => array(

'template_path_stack' => array(

__DIR__ . '/../view',

),

),

);


