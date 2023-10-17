<?php

class Connection {
    private $connection;

    public function __construct() {
        $dotenv = parse_ini_file(__DIR__ . '/../.env');

        $dbHost = $dotenv['DB_HOST'];
        $dbPort = $dotenv['DB_PORT'];
        $dbName = $dotenv['DB_NAME'];
        $dbUser = $dotenv['DB_USER'];
        $dbPassword = $dotenv['DB_PASSWORD'];

        $this->connection = pg_connect(
            "host=$dbHost 
            port=$dbPort 
            dbname=$dbName 
            user=$dbUser 
            password=$dbPassword"
        );

        if (!$this->connection) {
            die("Error de conexión a PostgreSQL.");
        }
    }

    public function query($sql) {
        return pg_query($this->connection, $sql);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    
    public function close() {
        pg_close($this->connection);
    }
}
