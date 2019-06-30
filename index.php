<?php
require_once 'vendor/autoload.php';
require_once 'session.php';
require_once 'data.php';
require_once 'config.php';
require_once 'db.php';

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);

$s = trim($uri, "/");
$uriParts = explode('/', $s);


if (($uriParts[0] === '') && (count($uriParts) === 1)) {
    $controller = 'home-controller.php';
} elseif (($uriParts[0] === 'login') && (count($uriParts) === 1)) {
    $controller = 'login-controller.php';
} elseif (($uriParts[0] === 'dashboard') && (count($uriParts) === 1)) {
    $controller = 'dashboard-controller.php';
} elseif (($uriParts[0] === 'profile') && (count($uriParts) === 1)) {
    $controller = 'profile-controller.php';
} elseif (($uriParts[0] === 'logout') && (count($uriParts) === 1)) {
    $controller = 'logout-controller.php';
} elseif (($uriParts[0] === 'users') && (count($uriParts) === 1)) {
    $controller = 'users-controller.php';
} elseif (($uriParts[0] === 'user') && (count($uriParts) === 1)) {
    $controller = 'user-controller.php';
} elseif (($uriParts[0] === 'dictionaries') && (count($uriParts) === 1)) {
    $controller = 'dictionaries-controller.php';
} elseif (($uriParts[0] === 'habits') && (count($uriParts) === 1)) {
    $controller = 'habits-controller.php';
} elseif (($uriParts[0] === 'settings') && (count($uriParts) === 1)) {
    $controller = 'settings-controller.php';
} else {
    $controller = '404-controller.php';
}

require("controllers/"."$controller");
//require("views/"."$currentView");

