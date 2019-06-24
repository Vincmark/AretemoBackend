<?php




Class Database
{
    private $dbh;
    private function __construct()
    {
        $this->connect();
    }
    private function connect()
    {
        $dsn = 'mysql:dbname='.$db['database'].';host='.$db['host'].'127.0.0.1';
        $user = $db['user'] ;
        $password = $db['password'];

        try {
            $this->$dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return $this;
    }

}