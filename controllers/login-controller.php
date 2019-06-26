<?php

use Respect\Validation\Validator as v;

$formParams['email'] = '';
$formParams['password'] = '';

$formErrors['emailInvalid'] = false;
$formErrors['passwordInvalid'] = false;
$formErrors['userAbsent'] = false;
$formErrors['passwordWrong'] = false;

define("FORM_STATE_AUTHORIZED", 0);
define("FORM_STATE_CLEAR", 1);
define("FORM_STATE_ERRORS", 2);
define("FORM_STATE_SUCCESS", 3);

$formState = -1;

$isPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isPost = true;
}

//echo 'Auth=';
//var_dump($isAuth);
//echo 'Post=';
//var_dump($isPost);


// Checking for case
// Case - 0. We are authorized - redirect to default controller
// - authorized
if ($isAuth) {
    $formState = FORM_STATE_AUTHORIZED;
}

// Case - 1. We are loading clear login page - show clear login page
// - not authorized
// - no POST data
if ((!$isAuth) && (!$isPost)) {
    $formState = FORM_STATE_CLEAR;
} else {
    if ((!$isAuth) && ($isPost)) {

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

            }

            // Checking for password
            if (!$formErrors['userAbsent']) {
                if (!password_verify($formParams['password'], $users[0]['password'])) {
                    $formErrors['passwordWrong'] = true;
                }
            }

            // User session creation
            if (!$formErrors['userAbsent'] && !$formErrors['passwordWrong']) {
                $formState = FORM_STATE_SUCCESS;
                session_start();
                $_SESSION['username'] = $users[0]['username'];
                $_SESSION['user_id'] = $users[0]['user_id'];
                echo 'redirect to dashboard';
                //header("Location: /index.php");
            }
        }
        if ($formErrors['emailInvalid'] || $formErrors['passwordInvalid'] || $formErrors['userAbsent'] || $formErrors['passwordWrong']) {
            $formState = FORM_STATE_ERRORS;
        }
    }
}


echo $twig->render('login.html.twig',
    [
        'pageTitle' => 'Login',
        'formParams' => $formParams,
        'formErrors' => $formErrors,
        'formState' => $formState
    ]);


