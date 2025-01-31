<?php

namespace Controller;

use Model\ContatoModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController
{
    private $contatoModel;

    public function __construct(ContatoModel $contatoModel)
    {
        $this->contatoModel = $contatoModel;   
    }

    public function searchContatos($pessoaId, $searchTerm) {
        $contatos = $this->contatoModel->searchContatos($pessoaId, $searchTerm);
        return new Response(json_encode(['data' => $contatos]), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function updateContato(Request $request, $id) {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['tipo'], $data['valor'])) {
            return new Response(json_encode(['error' => 'Campos obrigatórios faltando.']), Response::HTTP_BAD_REQUEST);
        }
    
        $contato = new Model\Contato($id, $data['tipo'], $data['valor'], $data['pessoa_id']);
        $this->contatoModel->updateContato($contato);
        return new Response(json_encode(['message' => 'Contato atualizado com sucesso.']), Response::HTTP_OK);
    }
    
    public function deleteContato($id) {
        $this->contatoModel->deleteContato($id);
        return new Response(json_encode(['message' => 'Contato excluído com sucesso.']), Response::HTTP_OK);
    }

    public function getContatosByPessoa($pessoaId)
    {
        $contatos = $this->contatoModel->getContatosByPessoa($pessoaId);
        return new Response(json_encode(['data' => $contatos]), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function addContato(Request $request, $pessoaId)
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['tipo'], $data['valor'])) {
            return new Response(json_encode(['error' => 'Campos obrigatórios faltando.']), Response::HTTP_BAD_REQUEST);
        }

        $contato = new Model\Contato(null, $data['tipo'], $data['valor'], $pessoaId);
        try {
            $createdContato = $this->contatoModel->addContato($contato);
            return new Response(json_encode($createdContato), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response(json_encode(['error' => $e->getMessage()]), Response::HTTP_BAD_REQUEST);
        }
    }
}