<?php

use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;
use GerenciadorTarefas\App\Utilitarios\ParametroRequisicao;
use GerenciadorTarefas\App\Utilitarios\ValidaEmail;
use GerenciadorTarefas\App\Utilitarios\ValidaFormulario;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $email = ParametroRequisicao::get('email');
    $senha = ParametroRequisicao::get('senha');

    if (!ValidaFormulario::validarFormulario($email, $senha)) {
        respostaHttp([
            'msg' => 'Informe todos os dados obrigatórios!',
            'dados' => null
        ], 200);
    } elseif (!ValidaEmail::validarEmail($email)) {
        respostaHttp([
            'msg' => 'Formato de e-mail inválido!',
            'dados' => null
        ], 200);
    } else {
        $senha = md5($senha);
        $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);
        $usuario = $usuarioRepositorio->buscarUsuarioPeloEmailESenha($email, $senha);

        if (!$usuario) {
            respostaHttp([
                'msg' => 'Não existe um usuário cadastrado com esse e-mail e senha!',
                'dados' => null
            ], 404);
        } else {
            $usuario->id = intval($usuario->id);
            $usuario->ativo = $usuario->ativo == 1 ? true : false;
            respostaHttp([
                'msg' => 'Usuário encontrado com sucesso!',
                'dados' => $usuario
            ], 200);
        }

    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao buscar usuário pelo e-mail e senha = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se buscar o usuário pelo e-mail e senha!',
        'dados' => null
    ], 500);
}