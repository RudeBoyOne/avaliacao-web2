<?php
namespace Avaliacao\Web\Database;

use PDO;

class DatabaseConnection {

    private static $instance = null;
    private $path = "./Database/avaliacao.db";
    private $conn;

    public function __construct() {
        $dsn = "sqlite:{$this->path}";
        $this->conn = new PDO($dsn, null, null, [PDO::ATTR_PERSISTENT => true]);
    }
    

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }

}