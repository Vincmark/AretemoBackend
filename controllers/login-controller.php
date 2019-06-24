<?php

use Respect\Validation\Validator as v;


$dsn = 'mysql:dbname=' . $db['database'] . ';host=' . $db['host'] . ';charset=' . $db['charset'];
$user = $db['user'];
$password = $db['password'];

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
$result = $dbh->query('select * from users');
$users = $result->fetchAll(PDO::FETCH_ASSOC);
//var_dump($users);
foreach ($users as $user) {
    echo($user['name']);
}

$sql = 'SELECT EXISTS(SELECT * FROM users WHERE name=:name)';
$stmt = $dbh->prepare($sql);
$params = [':name' => 'Vova'];
$stmt->execute($params);
$users = $stmt->fetchColumn();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);




$formParams = [];
$formItemErrors = [];
$formError = false;


$isPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isPost = true;
}

echo 'Auth=';
var_dump($isAuth);
echo ' Post=';
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
    echo ' Password=';
    var_dump($isPassword);

    // check for user in DB
    if ($isEmail && $isPassword) {

        $dsn = 'mysql:dbname=' . $db['database'] . ';host=' . $db['host'] . ';charset=' . $db['charset'];
        $user = $db['user'];
        $password = $db['password'];

        try {
            $dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        $result = $dbh->query('select * from users');
        $users = $result->fetch(PDO::FETCH_ASSOC);
        var_dump($users);
        foreach ($users as $user) {
            echo($user['']);
        }

        echo 'DB OK';

    }


//    $formParams['email'] = '';
//    $isEmail = $valEmail = v::email()->validate('alexandre@gaigalas.net');
//    if ($isEmail) {
//        echo 'email is good';
//
//    } else {
//        echo 'email is bad';
//    }

//    if (!isset($_POST['email'])) {
//        $formItemErrors['email'] = true;
//    }
//    if (!isset($formItemErrors['email']) && (empty($_POST['email']))) {
//        $formItemErrors['email'] = true;
//    }
//    if (!isset($formItemErrors['email']) && (strlen($_POST['email']) === 0)) {
//        $formItemErrors['email'] = true;
//    }
//    if (!isset($formItemErrors['email'])) {
//        $formParams['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
//        if ($formParams['email'] !== false) {
//            $formParams['email'] = mysqli_real_escape_string($dbConnection, $_POST['email']);
//        } else {
//            $formParams['email'] = mysqli_real_escape_string($dbConnection, $_POST['email']);
//            $formItemErrors['email'] = true;
//        }
//    }
    //password


    echo 'Case 2';
    // if data valid
    echo 'Case 3';

    //session_start();
//$_SESSION['username'] = 'Alexey';
//$_SESSION['user_id'] = '15';
//header("Location: /home-controller.php");
}


//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $loginSuccess = 0;
//    if ($_POST['user_name'] === 'Alexey') {
//        echo('Right name');
//        $loginSuccess++;
//    } else {
//        echo('Bad name ' . $_POST['user_name']);
//    }
//    if ($_POST['password'] === '12345') {
//        echo('Right password');
//        $loginSuccess++;
//    } else {
//        echo('Bad password ' . $_POST['password']);
//    }
//    if ($loginSuccess === 2) {
//        echo("Login!!!");
//        header("Location: /dashboard");
//
//    }
//}


echo $twig->render('login.html.twig', ['pageTitle' => 'Login']);
