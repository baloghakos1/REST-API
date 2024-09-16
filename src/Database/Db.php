<?php
namespace App\Database;

class DB {

    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = null;
    const DATABASE = 'ok';//még kell jót írni;

    protected $mysqli;

    function __construct(
        $host = 'localhost',
        $user = 'root',
        $password = null,
        $database = 'postoffice')
        {
            $this->mysqli=mysqli_connect(
                hostname: $host,
                username: $user,
                password: $password,
                database: $database);
            if (!$this->mysqli) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $this->mysqli->set_charset(charset: "utf8mb4");
        }

        function __destruct()
        {
            $this->mysqli->close();
        }
}