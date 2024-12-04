<?php
session_start();

// Récupération de l'EntityManager
$entityManager = require_once __DIR__ . '/../config/bootstrap.php';

require_once __DIR__ . '/../vendor/autoload.php';

// Récupération des routes
$routes = require_once __DIR__ . '/../config/routes.php';

// Récupération de l'URL actuelle
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Recherche de la route correspondante
if (!isset($routes[$uri])) {
    $errorController = new \App\Controleurs\ErrorController();
    $errorController->error404();
    exit;
}

// Récupération du contrôleur et de l'action
[$controllerName, $action] = $routes[$uri];
$controllerClass = "App\\Controleurs\\{$controllerName}";

//if ($controllerName == "InscriptionControleur"){
//    $createAccount = new \App\UsersStory\CreateAccount($entityManager);
//    $inscriptionControleur = new \App\Controleurs\InscriptionControleur($createAccount);
//    $inscriptionControleur->$action();
//}elseif ($controllerName == "ConnexionControleur"){
//    $loginUser = new \App\UsersStory\Login($entityManager);
//    $connexionController = new \App\Controleurs\ConnexionControleur($loginUser);
//    $connexionController->$action();
//}else{
    try {
        // Instanciation du contrôleur et appel de l'action
        $controller = new $controllerClass($entityManager);
        $controller->$action();
    } catch (\Exception $e) {
        error_log($e->getMessage());
        $errorController = new \App\Controleurs\ErrorController();
        $errorController->error404();
    }

