<?php

if (!$isAuth) {
    //http_response_code(403);
    header("Location: /login");
}

echo $twig->render('page--dictionaries.twig',
    [
        'pageTitle' => 'Dictionaries',
    ]);
