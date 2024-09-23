<?php
namespace Avaliacao\Web\Repository;

use Avaliacao\Web\Common\DateTimeZoneCustom;
use PDO;

class LogRepository {

    private $connection;
    private $table = "log";


    public function __construct($connection) {
       $this->connection = $connection;
    }


    public function createLog($log) {
        $acao = $log->getAcao();
        $data_hora = DateTimeZoneCustom::getCurrentDateTime();
        $produto_id = $log->getProduto();
        $userInsert = $log->getUserInsert();
        
        $query = "INSERT INTO $this->table (acao, data_hora, produto_id, userInsert) VALUES (:acao, :data_hora, :produto_id, :userInsert)";
        
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(":acao", $acao);
        $stmt->bindParam(":data_hora", $data_hora);
        $stmt->bindParam(":produto_id", $produto_id);
        $stmt->bindParam(":userInsert", $userInsert);
        
        $stmt->execute();
    }

    public function getAllLog() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}