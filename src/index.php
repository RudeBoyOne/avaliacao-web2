<?php
namespace Avaliacao\Web;

use Avaliacao\Web\Controller\LogController;
use Avaliacao\Web\Controller\ProdutoController;
use Avaliacao\Web\Database\DatabaseConnection;
use Avaliacao\Web\Repository\LogRepository;
use Avaliacao\Web\Repository\ProdutoRepository;

require_once "../vendor/autoload.php";


header('Content-Type: application/json');

$produtoRepository = new ProdutoRepository();
$produtoController = new ProdutoController($produtoRepository);
$logRepository = new LogRepository();
$logController = new LogController($logRepository);
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


switch($method){
    case 'GET':

            if ($uri == '/produto') {
                $produtoController->getAll();
            }

            if(preg_match('/\/produto\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'));
                $produtoController->searchById($id);
                break;
            } 

            if( $uri == '/log'){
                $logController->getAll();
            }
    break;
    case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                $produtoController->create($data);
    break;
    case 'PUT':
            if(preg_match('/\/produto\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $data = json_decode(file_get_contents('php://input'));
                $produtoController->update($id, $data);
            }
    break;
    case 'DELETE':
            if(preg_match('/\/produto\/(\d+)/', $uri, $match)){
                $id = $match[1];
                $produtoController->delete($id);
            }
    break;
}