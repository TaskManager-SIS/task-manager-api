<?php

use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);
    $usuarios = $usuarioRepositorio->buscarTodosUsuarios();
    $quantidadeUsuariosCadastrados = count($usuarios);

    if ($quantidadeUsuariosCadastrados > 0) {
        
        foreach ($usuarios as $usuario) {
            $usuario->id = intval($usuario->id);

            if ($usuario->ativo == 1) {
                $usuario->ativo = true;
            } else {
                $usuario->ativo = false;
            }

        }

    }

    respostaHttp([
        'msg' => 'Existe um total de ' . $quantidadeUsuariosCadastrados . ' usuários cadastrados!',
        'dados' => $usuarios
    ], 200);
} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao buscar todos os usuários = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se concultar todos os usuários!',
        'dados' => null
    ], 500);
}