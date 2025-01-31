<?php

namespace Model;

class Contato {
    private $id;
    private $tipo;
    private $valor;
    private $pessoaId;

    public function __construct($id, $tipo, $valor, $pessoaId) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->pessoaId = $pessoaId;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id; 
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getPessoaId() {
        return $this->pessoaId;
    }
}