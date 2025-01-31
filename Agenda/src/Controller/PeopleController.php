<?php

namespace Controller;

use Model\PessoaModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PeopleController
{
    private $pessoaModel;

    public function __construct(PessoaModel $pessoaModel)
    {
        $this->pessoaModel = $pessoaModel;   
    }

    public function updatePessoa(Request $request, $id) {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['nome'], $data['tipo'])) {
            return new Response(json_encode(['error' => 'Campos obrigatórios faltando.']), Response::HTTP_BAD_REQUEST);
        }
    
        $pessoa = new Model\Pessoa($id, $data['nome'], $data['tipo']);
        $this->pessoaModel->updatePessoa($pessoa);
        return new Response(json_encode(['message' => 'Pessoa atualizada com sucesso.']), Response::HTTP_OK);
    }
    
    public function deletePessoa($id) {
        $this->pessoaModel->deletePessoa($id);
        return new Response(json_encode(['message' => 'Pessoa excluída com sucesso.']), Response::HTTP_OK);
    }

    public function getPessoas()
    {
        $pessoas = $this->pessoaModel->getAllPessoas();
        return new Response(json_encode(['data' => $pessoas]), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function searchPessoas(Request $request) {
        $searchTerm = $request->query->get('search');
        $pessoas = $this->pessoaModel->searchPessoas($searchTerm);
        return new Response(json_encode(['data' => $pessoas]), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function addPessoa(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['nome'], $data['tipo'])) {
            return new Response(json_encode(['error' => 'Campos obrigatórios faltando.']), Response::HTTP_BAD_REQUEST);
        }

        $pessoa = new Model\Pessoa(null, $data['nome'], $data['tipo']);
        try {
            $createdPessoa = $this->pessoaModel->addPessoa($pessoa);
            return new Response(json_encode($createdPessoa), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response(json_encode(['error' => $e->getMessage()]), Response::HTTP_BAD_REQUEST);
        }
    }
}