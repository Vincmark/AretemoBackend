<?php
require_once 'vendor/autoload.php';
require_once 'session.php';
require_once 'config.php';
require_once 'db.php';

//use Respect\Validation\Validator as v;


//$number = 123;
//echo(v::numeric()->validate($number)); // true
//$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
//echo($usernameValidator->validate('alganet')); // true
//
//$valEmail = v::email();
//
//try {
//    $valEmail->assert('alexandre@gaigalas.net');
//} catch(NestedValidationException $exception) {
//    echo $exception->getFullMessage();
//}

//$valEmail = v::email();
//$res = $valEmail->validate('alex@andregaigalas.net');
//var_dump($res);
//$res = $valEmail->validate('alexandre@gaigalas.net');
//var_dump($res);
//echo ($valEmail->validate('1'));
//if ($valEmail === true){
//    echo 'email is good';
//} else
//    echo 'email is bad';
//var_dump($valEmail);

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
////$template = $twig->load('404.html.twig');
//echo $twig->render('404.html.twig', ['pageTitle' => 'Error 404']);

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
} else {
    $controller = '404-controller.php';
}

require("controllers/"."$controller");
//require("views/"."$currentView");

