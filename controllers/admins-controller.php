<?php


if (!$isAuth) {
    //http_response_code(403);
    header("Location: /login");
}


$formIn = 0; // 0 - not set;  1 - clear form; 2 - filter is ON
$formOut = 0; // 0 - not set; 1 - show clear form; 2 - show filtered form

$formParams['search'] = '';
$formParams['password'] = '';


echo $twig->render('page--admins.twig',
    [
        'pageTitle' => 'Dictionaries',
    ]);

