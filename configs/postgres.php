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

        try {
            $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName;user=$dbUser;password=$dbPassword";
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión a PostgreSQL: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function close()
    {
        $this->connection = null;
    }
}

?>
