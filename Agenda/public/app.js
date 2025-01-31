//angular.module('myApp', [])
//.controller('myCtr', function($scope, $http) {
   // $scope.pessoas = [];
 //   $scope.contatos = [];
 //   $scope.selectedPessoaId = null;
   // $scope.searchTerm = '';
   // $scope.contatoId = null; 

    
    // adicionar pessoas
    //$scope.addPessoa = function() {
    //    $http.post('http://localhost:8000/api/pessoas', {
     //       nome: $scope.nome,
     //       tipo: $scope.tipo
      //  }).then(function(response) {
      //      $scope.loadPessoas();
     ///       $scope.nome = '';
     //       $scope.tipo = '';
    //    }, function(error) {
    //        console.error('Erro ao adicionar pessoa:', error);
   //     });
    //};

    // carregar pessoas 
    //$scope.loadPessoas = function() {
    //    $http.get('http://localhost:8000/api/pessoas')
     //   .then(function(response) {
    //        $scope.pessoas = response.data.data;
    //    }, function(error) {
       //     console.error('Erro ao carregar pessoas:', error);
    //    });
   // };


    // carregar pessoas 
  //  $scope.loadPessoas = function() {
   //     $http.get('http://localhost:8000/api/pessoas')
     //   .then(function(response) {
     //       $scope.pessoas = response.data.data;
    //    }, function(error) {
    //        console.error('Erro ao carregar pessoas:', error);
    //    });
    //};

    // carregar contatos de uma pessoa
    //$scope.loadContatos = function(pessoaId) {
    //    $scope.selectedPessoaId = pessoaId; // Armazenar o ID da pessoa selecionada
    //    $http.get('http://localhost:8000/api/pessoas/' + pessoaId + '/contatos')
     //   .then(function(response) {
      //      $scope.contatos = response.data.data;
      //  }, function(error) {
      //     console.error('Erro ao carregar contatos:', error);
      //  });
    //};

    // adiciona contato
    //$scope.addContato = function() {
        
       // $http.post('http://localhost:8000/api/pessoas/' + $scope.selectedPessoaId + '/contatos', {
     //       tipo: $scope.tipoContato,
     //       valor: $scope.valorContato
     //   }).then(function(response) {
    //        $scope.loadContatos($scope.selectedPessoaId);
     //      $scope.tipoContato = ''; 
      //      $scope.valorContato = ''; 
       // }, function(error) {
       //     console.error('Erro ao adicionar contato:', error);
       // });
    //};

    //$scope.openEditModal = function(contato) {
    //    $scope.tipoContato = contato.tipo;
     //   $scope.valorContato = contato.valor;
     //   $scope.contatoId = contato.id;
     //   $('#contatoModal').modal('show');
    //};

    // salvar contato (adicionar ou editar)
    //$scope.saveContato = function() {
       // if ($scope.contatoId) {
            // Editar contato
         //   $http.put('http://localhost:8000/api/contatos/' + $scope.contatoId, {
        //        tipo: $scope.tipoContato,
         //       valor: $scope.valorContato
        //    }).then(function(response) {
       //         $scope.loadContatos($scope.selectedPessoaId);
       //         $('#contatoModal').modal('hide');
      //      }, function(error) {
      //          console.error('Erro ao atualizar contato:', error);
       //     });
       // } else {
            // Adicionar novo contato
     //       $http.post('http://localhost:8000/api/pessoas/' + $scope.selectedPessoaId + '/contatos', {
       //         tipo: $scope.tipoContato,
        //        valor: $scope.valorContato
          //  }).then(function(response) {
           //     $scope.loadContatos($scope.selectedPessoaId);
           //     $('#contatoModal').modal('hide');
           // }, function(error) {
           //     console.error('Erro ao adicionar contato:', error);
           // });
        //}
    //};

    // pesquisar contatos
    ///$scope.searchContatos = function() {
       // if ($scope.selectedPessoaId) {
       //     $http.get('http://localhost:8000/api/pessoas/' + $scope.selectedPessoaId + '/contatos?search=' + $scope.searchTerm)
        //    .then(function(response) {
         //       $scope.contatos = response.data.data;
         //   }, function(error) {
          //      console.error('Erro ao pesquisar contatos:', error);
         //   });
      //  }
    //};

    //$scope.loadPessoas();



    //-----------------------------------------------------------------------//

    angular.module('myApp', [])
    .controller('myCtr', function($scope) {
        $scope.contatos = [];
        $scope.tipoContato = '';
        $scope.valorContato = '';
        $scope.Contato = ''; 
        $scope.contatoId = null; 

        $scope.pessoas = [];
        $scope.nome = '';
        $scope.tipo = '';
        $scope.pessoaId = null; 
    
        //adicionar contato
        $scope.addContato = function() {
            if ($scope.valorContato && $scope.tipoContato && $scope.Contato) {
                const novoContato = {
                    id: $scope.contatos.length + 1, 
                    tipo: $scope.tipoContato,
                    valor: $scope.valorContato,
                    Contato: $scope.Contato 
                };
                $scope.contatos.push(novoContato); 
                $scope.tipoContato = ''; 
                $scope.valorContato = ''; 
                $scope.Contato = ''; 
            } else {
                alert("Por favor, preencha todos os campos.");
            }
        };
    
        // função para abrir modal
        $scope.openEditModal = function(contato) {
            $scope.tipoContato = contato.tipo;
            $scope.valorContato = contato.valor;
            $scope.Contato = contato.Contato; 
            $scope.contatoId = contato.id;
            $('#contatoModal').modal('show'); 
        };
    
        // função para salvar contato (adicionar ou editar)
        $scope.saveContato = function() {
            if ($scope.contatoId) {
                const contato = $scope.contatos.find(c => c.id === $scope.contatoId);
                if (contato) {
                    contato.tipo = $scope.tipoContato;
                    contato.valor = $scope.valorContato;
                    contato.Contato = $scope.Contato; 
                }
                $scope.contatoId = null; 
            } else {
                $scope.addContato();
            }
            $('#contatoModal').modal('hide'); 
        };
    
        // função para excluir contato
        $scope.deleteContato = function(contatoId) {
            $scope.contatos = $scope.contatos.filter(c => c.id !== contatoId);
        };
    
        $scope.searchContatos = function() {};
        
        //=====================================JS DE PESSOA=========================================//

        $scope.addPessoa = function() {
            if ($scope.nome && $scope.tipo) {
                const novaPessoa = {
                    id: $scope.pessoas.length + 1, // Gera um ID simples
                    nome: $scope.nome,
                    tipo: $scope.tipo
                };
                $scope.pessoas.push(novaPessoa);
                $scope.nome = ''; 
                $scope.tipo = ''; 
            } else {
                alert("Por favor, preencha todos os campos.");
            }
        };
    
        // função para abrir o modal
        $scope.openEditModal = function(pessoa) {
            $scope.nome = pessoa.nome;
            $scope.tipo = pessoa.tipo;
            $scope.pessoaId = pessoa.id;
            $('#pessoaModal').modal('show'); 
        };
    
        //salvar pessoa 
        $scope.savePessoa = function() {
            if ($scope.pessoaId) {
              
                const pessoa = $scope.pessoas.find(p => p.id === $scope.pessoaId);
                if (pessoa) {
                    pessoa.nome = $scope.nome;
                    pessoa.tipo = $scope.tipo;
                }
                $scope.pessoaId = null; 
            } else {
              
                $scope.addPessoa();
            }
            $('#pessoaModal').modal('hide'); 
        };
    
        //excluir pessoa
        $scope.deletePessoa = function(pessoaId) {
            $scope.pessoas = $scope.pessoas.filter(p => p.id !== pessoaId);
        };
        
        $scope.searchPessoas = function() {};
    });