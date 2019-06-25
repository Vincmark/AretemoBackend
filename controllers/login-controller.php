<?php

use Respect\Validation\Validator as v;


$formParams = [];
$formItemErrors = [];
$formError = false;
$isUserVerified = true;
$isEmail = false;
$pEmail = '';
$isPassword = false;
$pPassword = '';

echo '<pre>';

$isPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isPost = true;
}

echo 'Auth=';
var_dump($isAuth);
echo 'Post=';
var_dump($isPost);


// Checking for case
// Case - 0. We are authorized - redirect to default controller
// - authorized
if ($isAuth) {
    echo 'Case 0';
}

// Case - 1. We are loading clear login page - show clear login page
// - not authorized
// - no POST data
if ((!$isAuth) && (!$isPost)) {
    echo 'Case 1';
}

// Case 2 - not good login
// Case 3 - good login
if ((!$isAuth) && ($isPost)) {
    // if data is not valid
    //email
    $isEmail = true;
    if (isset($_POST['email'])) {
        $pEmail = $_POST['email'];
    } else {
        $isEmail = false;
    }

    if ($isEmail) {
        $pEmail = trim($pEmail);
        $vEmail = v::email();
        $isEmail = $vEmail->validate($pEmail);
    }

    // password
    $isPassword = true;
    if (isset($_POST['password'])) {
        $pPassword = $_POST['password'];
    } else {
        $isPassword = false;
    }

    if ($isPassword) {
        $vPassword = v::alnum()->noWhitespace()->length(3, 32);
        $isPassword = $vPassword->validate($pPassword);
    }

    echo 'Email=';
    var_dump($isEmail);
    echo 'Password=';
    var_dump($isPassword);

    // check for user in DB
    if ($isEmail && $isPassword) {
        $users = dbExecute($dbh, 'SELECT * FROM users WHERE email=:email', [':email' => $pEmail]);
        if (count($users) === 0) {
            $isUserVerified = false;

        }

        // Checking for password
        if ($isUserVerified) {
            if (!password_verify($pPassword, $users[0]['password'])) {
                $isUserVerified = false;
            }
        }

        // User session creation
        if ($isUserVerified) {
            session_start();
            $_SESSION['username'] = $users[0]['username'];
            $_SESSION['user_id'] = $users[0]['user_id'];
            echo 'redirect to dashboard';
            //header("Location: /index.php");
        }
    }
}

echo 'isUserVerified=';
var_dump($isUserVerified);
echo '</pre>';


echo $twig->render('login.html.twig',
    [
        'pageTitle' => 'Login',
        'isEmail' => $isEmail,
        'pEmail' => $pEmail,
        'isPassword' => $isPassword,
        'pPassword' => $pPassword
    ]);


