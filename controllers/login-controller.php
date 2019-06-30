<?php

use Respect\Validation\Validator as v;

//echo password_hash('23456',PASSWORD_DEFAULT);


$formIn = 0; // 0 - not set;  1 - clear form; 2 - checking for credentials
$formOut = 0; // 0 - not set; 1 - authorized and redirect; 2 - send credentials to itself; 3 - credentials error; 4 - credentials good and redirect

$formParams['email'] = '';
$formParams['password'] = '';

$formErrors['emailInvalid'] = false;
$formErrors['passwordInvalid'] = false;
$formErrors['userAbsent'] = false;
$formErrors['passwordWrong'] = false;

$isPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isPost = true;
}

$formIn = 1;
if ($isPost) {
    $formIn = 2;
}

if ($isAuth) {
    $formOut = 1;
}

if (($formOut !== 1) && ($formIn === 1)) {
    $formOut = 2;
    //echo 'clear';
} elseif (($formOut !== 1) && ($formIn === 2)) {
    //echo 'post';
    //email
    if (isset($_POST['email'])) {
        $formParams['email'] = $_POST['email'];
    } else {
        $formErrors['emailInvalid'] = true;
    }

    if (!$formErrors['emailInvalid']) {
        $formParams['email'] = trim($formParams['email']);
        $vEmail = v::email();
        if (!$vEmail->validate($formParams['email'])) {
            echo 'Invalid Email';
            $formErrors['emailInvalid'] = true;
        }
    }

    // password
    if (isset($_POST['password'])) {
        $formParams['password'] = $_POST['password'];
    } else {
        $formErrors['passwordInvalid'] = true;
    }


    $vPassword = v::alnum()->noWhitespace()->length(3, 32);
    if (!$vPassword->validate($formParams['password'])) {
        $formErrors['passwordInvalid'] = true;
    }

    // check for user in DB
    if ((!$formErrors['emailInvalid']) && (!$formErrors['passwordInvalid'])) {
        $users = dbExecute($dbh, 'SELECT * FROM users WHERE email=:email', [':email' => $formParams['email']]);
        if (count($users) === 0) {
            $formErrors['userAbsent'] = true;
        } else {
            echo 'user found';
        }

        // Checking for password
        if (!$formErrors['userAbsent']) {
            if (!password_verify($formParams['password'], $users[0]['password'])) {
                $formErrors['passwordWrong'] = true;
            } else {
                $formOut = 4;
            }
        }
    }

    if ($formErrors['emailInvalid'] || $formErrors['passwordInvalid'] || $formErrors['userAbsent'] || $formErrors['passwordWrong']) {
        $formOut = 3;
    }
}

//echo '<pre>';
//echo 'FormIn = '.$formIn;
//echo '<br>';
//echo 'FormOut = '.$formOut;
//echo '<br>';
//echo 'isPost = '.$isPost;
//var_dump($isPost);
//echo '<br>';
//echo 'isAuth = '.$isAuth;
//var_dump($isAuth);
//echo '<br>';
//echo '<br>';
//echo '</pre>';

if ($formOut === 1) {
    // auth redirect
    echo 'Authorized. Redirect to dashboard';
    header("Location: /dashboard");
} elseif (($formOut === 2) || ($formOut === 3)) {
    // show form
    echo $twig->render('page--login.twig',
        [
            'pageTitle' => 'Login',
            'menuList' => $menuList,
            'formParams' => $formParams,
            'formErrors' => $formErrors,
            'formOut' => $formOut
        ]);

} elseif ($formOut === 4) {
    // success redirect
    //session_start();
    $_SESSION['username'] = $users[0]['name'];
    $_SESSION['user_id'] = $users[0]['id'];
    echo 'Success login. Redirect to dashboard';
    header("Location: /dashboard");
}





