<?php
namespace Avaliacao\Web\Common;


class Validator {

    private static $comprimentoNomeProduto = 3;

    public static function validationProduto($data) {
        $validNome = Validator::productNameValidation($data->nome);
        $validPreco =  Validator::productPriceValidation($data->preco);
        $validEstoque = Validator::productStockValidation($data->estoque);

        $validations = [$validNome, $validPreco, $validEstoque];

        foreach ($validations as $key => $result) {
            if (is_array($result)) {
                ProblemAndFiledError::addFieldsWithError($result);
            }
        }

        if (!empty(ProblemAndFiledError::getFieldsError())) {
            return false;
        }

        return true;
    }

    // O nome do produto deve ter no mínimo 3 caracteres.
    private static function productNameValidation($nome) {
        $problemsAndErrors = array();
        
        $isValid = strlen(trim($nome)) >= Validator::$comprimentoNomeProduto;
        
        if (!$isValid) {
            $problemsAndErrors = ["field" => "Nome", "message" => "Nome do produto deve ter no mínimo 3 caracteres"];
            
            return $problemsAndErrors;
        }
        
        return $isValid;
    }
    
    // O preço deve ser um valor positivo.
    private static function productPriceValidation($preco) {
        $problemsAndErrors = array();
        $isFloat = is_float($preco);
        
        if (!$isFloat || $preco < 0) {
            $problemsAndErrors = ["field" => "Preço", "message" => "O preço do produto deve ser um número de ponto flutuante e positivo"];
            
            return $problemsAndErrors;
        }
        
        return $isFloat;
    }
    
    // O estoque deve ser um número inteiro maior ou igual a zero.
    private static function productStockValidation($estoque) {
        $problemsAndErrors = array();
        $isInt = is_int($estoque);
        
        if (!$isInt || $estoque < 0) {
            $problemsAndErrors = ["field" => "Estoque", "message" => "O estoque para o produto deve ser um número inteiro e positivo"];
            
            return $problemsAndErrors;
        }

        return $isInt;
    }


}
