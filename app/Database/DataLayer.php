<?php
namespace DB;

use PDO;
use Redis;

class DataLayer
{
    private static $instance = null;
    // Create a new connection
    /*host and database name*/
    private $pdo_connection;
    /*name of database user*/
    private $pdo_parameters = 'mysql:host=school_project_mysql_1;dbname=school';
    /*user database password*/
    private $database_user = 'root';
    private $user_password = '123456';
    private $redis;
    private $myConnections = [];

    private function __construct()
    {
        // Create a new connection.
        try {
            $this->pdo_connection = new PDO($this->pdo_parameters, $this->database_user, $this->user_password);
            $this->pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Mysql Connection failed: " . $e->getMessage();
        }

        // Redis Connection
        try {
            $this->redis = new Redis();
            $this->redis->connect('school_project_redis_1', 6379);
        }
        catch (PDOException $e) {
            echo "Redis Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DataLayer();
        }
        return self::$instance;
    }

    private function getmyConnections() {
        return $this->myConnections = ['mysql' => $this->pdo_connection, 'redis' => $this->redis];
    }

    // Get an open connection for all DB transactions
    public function getConnection()
    {
        return $this->getmyConnections();
    }

}