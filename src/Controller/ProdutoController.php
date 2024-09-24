<?php
namespace Avaliacao\Web\Controller;

use Avaliacao\Web\Common\ProblemAndFiledError;
use Avaliacao\Web\Common\ResponseAssemblerError;
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
        
        echo $result;
    }

}
