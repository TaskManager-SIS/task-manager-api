<?php

namespace GerenciadorTarefas\App\Utilitarios;

use PDO;

class ConexaoBancoDados
{

    public static function obterConexaoBancoDados() {
        $usuarioBanco = 'root';
        $senhaUsuarioBancoDAdos = 'root';
        $bancoDados = 'db_gerenciador_tarefas';
        $pdo = new PDO('mysql:host=mysql;dbname=' . $bancoDados, $usuarioBanco, $senhaUsuarioBancoDAdos);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        return $pdo;
    }
}