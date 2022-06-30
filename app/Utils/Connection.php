<?php

namespace Welldex\Utils;

use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

class Connection
{
    private string $host        = 'localhost';
    private string $user        = 'root';
    private string $password    = '1408';
    private string $database    = 'hh_transportes';

    public function __construct() {}

    private static function getInstance() {}

    public function getConnection()
    {
        $pdo = new PDOConnector(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        $pdoConn = $pdo->connect('utf8', []);
        $dbConn = new Mysql($pdoConn);

        return $dbConn;
    }

}
?>