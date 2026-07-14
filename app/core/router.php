<?php

function dispatch()
{
    // Define routes
    $routes = [
        '/login' => [
            'controller' => 'auth',
            'action' => 'login',
            'role' => null
        ],
        '/logout' => [
            'controller' => 'auth',
            'action' => 'logout',
            'role' => null
        ],
        '/inscription' => [
            'controller' => 'auth',
            'action' => 'inscription',
            'role' => null
        ],
        '/gerant/dashboard' => [
            'controller' => 'gerant',
            'action' => 'dashboard',
            'role' => 'GERANT'
        ],
        '/gerant/apprenants' => [
            'controller' => 'gerant',
            'action' => 'apprenants',
            'role' => 'GERANT'
        ],
        '/apprenant/dashboard' => [
            'controller' => 'apprenant',
            'action' => 'dashboard',
            'role' => 'APPRENANT'
        ]
    ];

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = rtrim($uri, '/');

    if ($uri === '') {
        $uri = '/';
    }

    // Default route
    if ($uri === '/' || $uri === '/index.php') {
        header('Location: /login');
        exit;
    }

    if (isset($routes[$uri])) {
        $route = $routes[$uri];
        $controller = $route['controller'];
        $action = $route['action'];
        $requiredRole = $route['role'];

        // Access Control
        require_once dirname(__DIR__) . '/core/sessionManager.php';
        startSession();
        $user = getData('user');

        if ($requiredRole !== null) {
            if ($user === null) {
                header('Location: /login');
                exit;
            }

            if ($user['role'] !== $requiredRole) {
                http_response_code(403);
                echo "Accès interdit : vous n'avez pas le rôle requis.";
                exit;
            }
        } else {
            // If already logged in and tries to access login or register
            if ($user !== null && ($uri === '/login' || $uri === '/inscription')) {
                if ($user['role'] === 'GERANT') {
                    header('Location: /gerant/dashboard');
                } elseif ($user['role'] === 'APPRENANT') {
                    header('Location: /apprenant/dashboard');
                } elseif ($user['role'] === 'COACH') {
                    header('Location: /coach/dashboard'); // fallback
                }
                exit;
            }
        }

        $controllerFile = dirname(__DIR__) . '/controllers/' . $controller . '.controller.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (function_exists($action)) {
                $action();
            } else {
                echo "Action introuvable : " . htmlspecialchars($action);
            }
        } else {
            echo "Contrôleur introuvable : " . htmlspecialchars($controllerFile);
        }
    } else {
        http_response_code(404);
        echo "Page introuvable";
    }
}
