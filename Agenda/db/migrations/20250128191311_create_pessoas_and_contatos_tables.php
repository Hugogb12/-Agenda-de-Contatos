<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreatePessoasAndContatosTables extends AbstractMigration
{
    public function change()
    {
        // tabela Pessoas
        $table = $this->table('pessoa');
        $table->addColumn('nome', 'string', ['limit' => 255])
              ->addColumn('tipo', 'string', ['limit' => 50])
              ->addTimestamps()
              ->create();

        // tabela de Contatos
        $table = $this->table('contato');
        $table->addColumn('tipo', 'string', ['limit' => 50])
              ->addColumn('valor', 'string', ['limit' => 255])
              ->addColumn('pessoa_id', 'integer')
              ->addForeignKey('pessoa_id', 'pessoa', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->addTimestamps()
              ->create();
    }
}