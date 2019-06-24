<?php

session_start();

$isAuth = false;
$userName = '';
$userId = 0;

if (isset($_SESSION['username'])) {
    $isAuth = true;
    $userName = $_SESSION['username'];
    $userId = $_SESSION['user_id'];
}