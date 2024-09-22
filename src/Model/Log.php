<?php
namespace Avaliacao\Web\Model;


class Log {

    private $id;
    private $acao;
    private $data_hora;
    private $produto_id;
    private $userInsert;

    public function __construct($acao, $data_hora, $produto_id, $userInsert) {
        $this->acao = $acao;
        $this->data_hora = $data_hora;
        $this->produto_id = $produto_id;
        $this->userInsert = $userInsert;
    }

    public function getId() {
        return $this->id;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function setAcao($acao) {
        $this->acao = $acao;
    }

    public function getData_hora() {
        return $this->data_hora;
    }

    public function setData_hora($data_hora) {
        $this->data_hora = $data_hora;
    }

    public function getProduto() {
        return $this->produto_id;
    }

    public function setProduto($produto_id) {
        $this->produto_id = $produto_id;
    }

    public function getUserInsert() {
        return $this->userInsert;
    }

    public function setUserInsert($userInsert) {
        $this->userInsert = $userInsert;
    }


}