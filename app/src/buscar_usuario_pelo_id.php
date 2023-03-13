<?php

use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;

try {

    if (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
        $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);
        $usuario = $usuarioRepositorio->buscarUsuarioPeloId($id);

        if (!$usuario) {
            respostaHttp([
                'msg' => 'Usuário não encontrado!',
                'dados' => null
            ], 404);
        } else {
            $usuario->id = intval($usuario->id);
            respostaHttp([
                'msg' => 'Usuário encontrado com sucesso!',
                'dados' => $usuario
            ], 200);
        }

    } else {
        respostaHttp([
            'msg' => 'Informe o id do usuário!',
            'dados' => null
        ], 400);
    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao buscar usuário pelo id = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se buscar o usuário pelo id!',
        'dados' => null
    ], 500);
}