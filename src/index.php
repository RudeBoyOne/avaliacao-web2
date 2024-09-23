<?php
namespace Avaliacao\Web;

use Avaliacao\Web\Database\DatabaseConnection;
use Avaliacao\Web\Model\Produto;
use Avaliacao\Web\Repository\LogRepository;
use Avaliacao\Web\Repository\ProdutoRepository;

require_once "../vendor/autoload.php";


header('Content-Type: application/json');

$produtoRepository = new ProdutoRepository;
$logRepository = new LogRepository(DatabaseConnection::getInstance());
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if ($method == 'GET' && $uri == '/produto') {

    $result = $produtoRepository->getAllProdutos();   

    echo json_encode([
        'status' => 'true',
        'message' => 'mensagem de sucesso',
        'data' => $result        
    ]);

}

if ($method == 'GET') {

    preg_match('/\/produto\/(\d+)/', $uri, $match);


    $result = $produtoRepository->searchByIdProduto($match[1]);   

    echo json_encode([
        'status' => 'true',
        'message' => 'mensagem de sucesso',
        'data' => $result        
    ]);

}


if ($method == 'POST' && $uri == '/produto') {

    $data = json_decode(file_get_contents('php://input'));

    $produtoModel = new Produto(
        $data->nome,
        $data->descricao,
        $data->preco,
        $data->estoque,
        $data->userInsert
    );
    
    $result = $produtoRepository->createProduto($produtoModel);
    
    echo $result;
    
}

if ($method == 'PUT' && preg_match('/\/produto\/(\d+)/', $uri, $match)) {

    $id = $match[1];
    
    echo $id;
    
    $data = json_decode(file_get_contents('php://input'));

    $produtoModel = new Produto(
        $data->nome,
        $data->descricao,
        $data->preco,
        $data->estoque,
        $data->userInsert
    );

    $result = $produtoRepository->updateProduto($id, $produtoModel);

    echo $result;
}

if ($method == 'DELETE') {

    preg_match('/\/produto\/(\d+)/', $uri, $match);


    $result = $produtoRepository->deleteByIdProduto($match[1]);   

    echo json_encode([
        'status' => 'true',
        'message' => 'Produto excluído com sucesso!',
        'data' => $result
    ]);

}

if ($method == 'GET' && $uri == '/log') {

    $result = $logRepository->getAllLog();   

    echo json_encode([
        'status' => 'true',
        'message' => 'mensagem de sucesso',
        'data' => $result        
    ]);

}