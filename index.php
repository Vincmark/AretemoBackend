<?php

require_once 'vendor/autoload.php';
echo "Hello World Aretemo";
echo $_SERVER['REQUEST_URI'];
echo $_SERVER['HTTP_HOST'];

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
//$template = $twig->load('404.html.twig');
echo $twig->render('404.html.twig',['pageTitle' => 'Error 404']);

