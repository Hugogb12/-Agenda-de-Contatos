<?php

namespace Model;

use Doctrine\DBAL\Driver\Connection;

class ContatoModel {
    private $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    public function getContatosByPessoa($pessoaId) {
        $sql = "SELECT * FROM contato WHERE pessoa_id = ?";
        $stmt = $this->db->executeQuery($sql, [$pessoaId]);
        return $stmt->fetchAll();
    }

    public function addContato(Contato $contato) {
        if ($this->isDuplicate($contato->getTipo(), $contato->getValor(), $contato->getPessoaId())) {
            throw new \Exception("Contato já cadastrado para esta pessoa.");
        }

        $sql = "INSERT INTO contato (tipo, valor, pessoa_id) VALUES (?, ?, ?)";
        $this->db->executeUpdate($sql, [
            $contato->getTipo(),
            $contato->getValor(),
            $contato->getPessoaId()
        ]);
        $contato->setId($this->db->lastInsertId());
        return $contato;
    }

    private function isDuplicate($tipo, $valor, $pessoaId) {
        $sql = "SELECT COUNT(*) FROM contato WHERE tipo = ? AND valor = ? AND pessoa_id = ?";
        $stmt = $this->db->executeQuery($sql, [$tipo, $valor, $pessoaId]);
        return $stmt->fetchColumn() > 0;
    }

    public function updateContato(Contato $contato) {
        $sql = "UPDATE contato SET tipo = ?, valor = ? WHERE id = ?";
        $this->db->executeUpdate($sql, [
            $contato->getTipo(),
            $contato->getValor(),
            $contato->getId()
        ]);
    }

    public function searchContatos($pessoaId, $searchTerm) {
        $sql = "SELECT * FROM contato WHERE pessoa_id = ? AND (tipo LIKE ? OR valor LIKE ?)";
        $stmt = $this->db->executeQuery($sql, [$pessoaId, "%$searchTerm%", "%$searchTerm%"]);
        return $stmt->fetchAll();
    }

    public function deleteContato($id) {
        $sql = "DELETE FROM contato WHERE id = ?";
        $this->db->executeUpdate($sql, [$id]);
    }
}