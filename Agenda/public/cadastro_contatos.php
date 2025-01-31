<!DOCTYPE html>
<html lang="pt-BR" ng-app="myApp" ng-controller="myCtr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="app.js"></script>
    <title>Cadastro de Contatos</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center">Cadastro de Contatos</h1>
        
        <form ng-submit="addContato()">
            <div class="form-group">
                <label for="valorContato">Valor do Contato:</label>
                <input type="text" id="valorContato" ng-model="valorContato" class="form-control" placeholder="Valor" required />
            </div>
            <div class="form-group">
                <label for="tipoContato">Tipo:</label>
                <select id="tipoContato" ng-model="tipoContato" class="form-control" required>
                    <option value="">Tipo</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Celular">Whatsapp</option>
                    <option value="E-mail">E-mail</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contato">Contato:</label>
                <input type="text" id="contato" ng-model="Contato" class="form-control" placeholder="Contato" required />
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Contato</button>
        </form>

        <h2>Pesquisar Contatos</h2>
        <input type="text" ng-model="searchTerm" class="form-control" placeholder="Pesquisar..." ng-change="searchContatos()" />

        <h2 class="mt-4">Lista de Contatos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Contato</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="contato in contatos | filter:searchTerm">
                    <td>{{contato.Contato}}</td>
                    <td>{{contato.valor}}</td>
                    <td>{{contato.tipo}}</td>
                    <td>
                        <button class="btn btn-warning btn-xs" ng-click="openEditModal(contato)">Editar</button>
                        <button class="btn btn-danger btn-xs" ng-click="deleteContato(contato.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="contatoModal" tabindex="-1" role="dialog" aria-labelledby="contatoModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contatoModalLabel">Editar Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" ng-model="Contato" placeholder="Contato" class="form-control" required />
                    <input type="text" ng-model="valorContato" placeholder="Valor" class="form-control" required />
                    <select ng-model="tipoContato" class="form-control" required>
                        <option value="">Tipo</option>
                        <option value="Telefone">Telefone</option>
                        <option value="Celular">Whatsapp</option>
                        <option value="E-mail">E-mail</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" ng-click="saveContato()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>