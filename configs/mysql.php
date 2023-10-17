<?php

class Connection
{
    private $connection;

    public function __construct()
    {
        $dotenv = parse_ini_file(__DIR__ . '/../.env');
        
        $dbHost = $dotenv['DB_HOST'];
        $dbPort = $dotenv['DB_PORT'];
        $dbName = $dotenv['DB_NAME'];
        $dbUser = $dotenv['DB_USER'];
        $dbPassword = $dotenv['DB_PASSWORD'];

        $this->connection = mysqli_connect(
            $dbHost,
            $dbUser,
            $dbPassword,
            $dbName,
                $dbPort,
        );

        if (!$this->connection) {
            die("Error de conexión a MySQL: " . mysqli_connect_error());
        }
    }
    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function close()
    {
        mysqli_close($this->connection);
    }
}
