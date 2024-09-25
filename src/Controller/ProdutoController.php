<?php
namespace Avaliacao\Web\Controller;

use Avaliacao\Web\Common\ProblemAndFiledError;
use Avaliacao\Web\Common\ResponseAssemblerError;
use Avaliacao\Web\Common\ResponseAssemblerSuccess;
use Avaliacao\Web\Common\Validator;
use Avaliacao\Web\Model\Produto;
use Avaliacao\Web\Repository\ProdutoRepository;

class ProdutoController {

    private $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepository) {
        $this->produtoRepository = $produtoRepository;
    }


    public function create($data) {
        $isValid = Validator::validationProduto($data);
        
        if (!$isValid) {
            ResponseAssemblerError::response(400, ProblemAndFiledError::getFieldsError());
            return;
        }
        
        $produtoModel = new Produto(
            $data->nome,
            $data->descricao,
            $data->preco,
            $data->estoque,
            $data->userInsert
        );
        
        $result = $this->produtoRepository->createProduto($produtoModel);
        
        ResponseAssemblerSuccess::response(201, $result);
    }
    
    public function update($id, $data) {
        $isValid = Validator::validationProduto($data);
        
        
        if (!$isValid) {
            ResponseAssemblerError::response(400, ProblemAndFiledError::getFieldsError());
            return;
        }
        
        $produtoModel = new Produto(
            $data->nome,
            $data->descricao,
            $data->preco,
            $data->estoque,
            $data->userInsert
        );
        
        $result = $this->produtoRepository->updateProduto($id, $produtoModel);
        
        ResponseAssemblerSuccess::response(200, $result);
    }

    public function getAll() {
        $result = $this->produtoRepository->getAllProdutos();
        ResponseAssemblerSuccess::response(200, $result);
    }

    public function searchById($id) {
        $result = $this->produtoRepository->searchByIdProduto($id);
        ResponseAssemblerSuccess::response(200, $result);
    }
    
    public function delete($id) {
        if ($this->produtoRepository->deleteByIdProduto($id)) {
            ResponseAssemblerSuccess::responseDelete(200);
        } else {
            ResponseAssemblerError::responseDelete(500);
        }
    }

}
