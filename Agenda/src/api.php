<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Doctrine\DBAL\DriverManager;
use Controller\PeopleController;
use Controller\ContactsController;

$app = new Application();

// Configuração da conexão com o banco de dados
$app['db'] = function() {
    return DriverManager::getConnection([
        'dbname' => 'agenda_contatos', 
        'user' => 'root',            
        'password' => '1234',       
        'host' => 'localhost',          
        'driver' => 'pdo_mysql',        
    ]);
};

// Modelos para pessoas e contatos
$app['pessoa_model'] = function() use ($app) {
    return new Model\PessoaModel($app['db']);
};

$app['contato_model'] = function() use ($app) {
    return new Model\ContatoModel($app['db']);
};

// Rotas para pessoas
$app->get('/api/pessoas', function (Request $request) use ($app) {
    $controller = new PeopleController($app['pessoa_model']);
    
    $searchTerm = $request->query->get('search');
    if ($searchTerm) {
        return $controller->searchPessoas($searchTerm);
    }
    
    return $controller->getPessoas();
});

$app->post('/api/pessoas', function (Request $request) use ($app) {
    $controller = new PeopleController($app['pessoa_model']);
    return $controller->addPessoa($request);
});

// Rotas para contatos
$app->get('/api/pessoas/{id}/contatos', function ($id, Request $request) use ($app) {
    $controller = new ContactsController($app['contato_model']);
    
    $searchTerm = $request->query->get('search');
    if ($searchTerm) {
        return $controller->searchContatos($id, $searchTerm);
    }
    
    return $controller->getContatosByPessoa($id);
});

$app->post('/api/pessoas/{id}/contatos', function (Request $request, $id) use ($app) {
    $controller = new ContactsController($app['contato_model']);
    return $controller->addContato($request, $id);
});

$app->run();