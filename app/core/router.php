<?php

$routes = [
    '/login' => [
        'controller' => 'auth',
        'action' => 'login'
    ],

    '/logout' => [
        'controller' => 'auth',
        'action' => 'logout'
    ],
    '/gerant/dashboard' => [
        'controller' => 'gerant',
        'action' => 'dashboard'
    ]
];