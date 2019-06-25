<?php

$dsn = 'mysql:dbname=' . $db['database'] . ';host=' . $db['host'] . ';charset=' . $db['charset'];
$user = $db['user'];
$password = $db['password'];

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'DB connection failed ' . $e->getMessage();
    die();
}



function dbQuery($dbh, $sql):array
{
    $result = $dbh->query($sql);
    if (!$result) {
        echo "Query Error.";
        die();
    }
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    var_dump($rows);
    return($rows);

}


function dbExecute($dbh, $sql, $params):array
{

    $stmt = $dbh->prepare($sql);
    if (!$stmt) {
        echo "Query Prepare Error.";
        die();
    }
    $stmt->execute($params);
    if (!$stmt) {
        echo "Query Execute Error.";
        die();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($rows);
    return($rows);
}

