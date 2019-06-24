<?php

$db = [
    'host' => 'localhost',
    'database' => 'aretemo',
    'charset' => 'utf8',
    'user' => 'root',
    'password' => ''
];


$cssPath = 'http://' . $_SERVER['HTTP_HOST'] . '/views/css/';
$jsPath = 'http://' . $_SERVER['HTTP_HOST'] . '/views/js/';
$imgPath = 'http://' . $_SERVER['HTTP_HOST'] . '/views/img/';
$uri = $_SERVER['REQUEST_URI'];
$host = $_SERVER['HTTP_HOST'];

$innerPage = true;
$uriParts = [];
$currentController = '';
$controllerResult = false;
$currentView = '';
