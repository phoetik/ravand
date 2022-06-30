<?php

use Ravand\Core\Router\ApiRouter;
use Ravand\Controllers\ControlPanelController;

// $prefix = RavandApi::
// register_rest_route( 'myplugin/v1', '/author/(?P<id>\d+)', array(
//     'methods' => 'GET',
//     'callback' => 'my_awesome_func',
//     'permission_callback' => '__return_true',
// ));

$apiRouter->get("/user/(?P<id>\d+)");

register_rest_route( 
    'myplugin/v1', 
    '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => function,
    'permission_callback' => '__return_true',
));


ApiRouter::get()

Router::fallback();