<!DOCTYPE html>
<html lang="pt-BR" ng-app="myApp" ng-controller="myCtr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="app.js"></script>
    <title>Cadastro de Pessoas</title>
</head>
<body> 
    <div class="container-fluid">
        <h1 class="text-center">Cadastro de Pessoas</h1>
        
        <form ng-submit="addPessoa()">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" ng-model="nome" class="form-control" placeholder="Nome" required />
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" ng-model="tipo" class="form-control" required>
                    <option value="">Tipo</option>
                    <option value="Físico">Físico</option>
                    <option value="Jurídico">Jurídico</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Pessoa</button>
        </form>

        <h2>Pesquisar Pessoas</h2>
        <input type="text" ng-model="searchTerm" class="form-control" placeholder="Pesquisar..." ng-change="searchPessoas()" />

        <h2 class="mt-4">Lista de Pessoas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="pessoa in pessoas | filter:searchTerm">
                    <td>{{pessoa.nome}}</td>
                    <td>{{pessoa.tipo}}</td>
                    <td>
                        <button class="btn btn-warning btn-xs" ng-click="openEditModal(pessoa)">Editar</button>
                        <button class="btn btn-danger btn-xs" ng-click="deletePessoa(pessoa.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="pessoaModal" tabindex="-1" role="dialog" aria-labelledby="pessoaModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pessoaModalLabel">Editar Pessoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" ng-model="nome" placeholder="Nome" class="form-control" required />
                    <select ng-model="tipo" class="form-control" required>
                        <option value="">Tipo</option>
                        <option value="Físico">Físico</option>
                        <option value="Jurídico">Jurídico</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" ng-click="savePessoa()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>