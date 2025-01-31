<?php

namespace Model;

use Doctrine\DBAL\Driver\Connection;

class PessoaModel {
    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    public function searchPessoas($searchTerm) {
        $sql = "SELECT * FROM pessoa WHERE nome LIKE ? OR tipo LIKE ?";
        $stmt = $this->db->executeQuery($sql, ["%$searchTerm%", "%$searchTerm%"]);
        return $stmt->fetchAll();
    }

    public function getAllPessoas() {
        $sql = "SELECT * FROM pessoa";
        $stmt = $this->db->executeQuery($sql);
        return $stmt->fetchAll();
    }

    public function addPessoa(Pessoa $pessoa) {
        if ($this->isDuplicate($pessoa->getNome())) {
            throw new \Exception("Nome já cadastrado.");
        }
    
        // verificar se o tipo é válido
        if (!in_array($pessoa->getTipo(), ['Físico', 'Jurídico'])) {
            throw new \Exception("Tipo deve ser 'Físico' ou 'Jurídico'.");
        }
    
        $sql = "INSERT INTO pessoa (nome, tipo) VALUES (?, ?)";
        $this->db->executeUpdate($sql, [
            $pessoa->getNome(),
            $pessoa->getTipo()
        ]);
        $pessoa->setId($this->db->lastInsertId());
        return $pessoa;
    }

    private function isDuplicate($nome) {
        $sql = "SELECT COUNT(*) FROM pessoa WHERE nome = ?";
        $stmt = $this->db->executeQuery($sql, [$nome]);
        return $stmt->fetchColumn() > 0;
    }

    public function updatePessoa(Pessoa $pessoa) {
        $sql = "UPDATE pessoa SET nome = ?, tipo = ? WHERE id = ?";
        $this->db->executeUpdate($sql, [
            $pessoa->getNome(),
            $pessoa->getTipo(),
            $pessoa->getId()
        ]);
    }

    public function deletePessoa($id) {
        $sql = "DELETE FROM pessoa WHERE id = ?";
        $this->db->executeUpdate($sql, [$id]);
    }
}