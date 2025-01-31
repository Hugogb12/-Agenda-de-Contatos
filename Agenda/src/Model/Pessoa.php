<?php

namespace Model;

class Pessoa {
    private $id;
    private $nome;
    private $tipo;

    public function __construct($id, $nome, $tipo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id; 
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }
}