<?php
namespace Avaliacao\Web\Repository;

use Avaliacao\Web\Database\DatabaseConnection;
use Avaliacao\Web\Common\DateTimeZoneCustom;
use Avaliacao\Web\Model\Log;
use Avaliacao\Web\Model\Produto;
use PDO;

class ProdutoRepository {

    private $connection;
    private $table = "produto";


    public function __construct() {
        $this->connection = DatabaseConnection::getInstance();
    }


    
    public function createProduto(Produto $produto) {
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $estoque = $produto->getEstoque();
        $userInsert  = $produto->getUserInsert();
        $data_hora = DateTimeZoneCustom::getCurrentDateTime();
        
        $query = "INSERT INTO $this->table (nome, descricao, preco, estoque, userInsert, data_hora) VALUES (:nome, :descricao, :preco, :estoque, :userInsert, :data_hora)";
        
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":userInsert", $userInsert);
        $stmt->bindParam(":data_hora", $data_hora);
        
        $stmt->execute();

        $this->genaratorLog("Criar produto", $data_hora, $this->connection->lastInsertId(), $userInsert);
    }
    
    public function updateProduto($id, Produto $produto) {
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $estoque = $produto->getEstoque();
        $userInsert  = $produto->getUserInsert();
        $data_hora = DateTimeZoneCustom::getCurrentDateTime();
        
        $query = "UPDATE $this->table SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, userInsert = :userInsert, data_hora = :data_hora WHERE produto.id = :produto_id";
        
        $stmt = $this->connection->prepare($query);
    
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":userInsert", $userInsert);
        $stmt->bindParam(":data_hora", $data_hora);
        $stmt->bindParam(":produto_id", $id);
        
        $stmt->execute();

        $this->genaratorLog("Atualizar produto", $data_hora, $id, $userInsert);
    }

    public function searchByIdProduto($id) {
        $query = "SELECT * FROM $this->table WHERE produto.id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllProdutos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByIdProduto($id) {
        $arraySearch = $this->searchByIdProduto($id);
        $userInsert = "";

        foreach ($arraySearch as $key => $value) {
            if ($key === 'userInsert') {
                $userInsert = $value;
            }
        }

        $query = "DELETE FROM produto WHERE produto.id = :id";
        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $this->genaratorLog("Deletar produto", DateTimeZoneCustom::getCurrentDateTime(), $id, $userInsert);
    }

    public function genaratorLog($acao, $data_hora, $produto_id, $userInsert) {
        $log = new Log($acao, $data_hora, $produto_id, $userInsert);

        $logRepository = new LogRepository($this->connection);

        $logRepository->createLog($log);
    }
}