<?php

use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\EnvioEmail;
use GerenciadorTarefas\App\Utilitarios\Log;
use GerenciadorTarefas\App\Utilitarios\ParametroRequisicao;
use GerenciadorTarefas\App\Utilitarios\ValidaEmail;

try {
    $email = ParametroRequisicao::get('email');

    if (empty($email)) {
        respostaHttp([
            'msg' => 'Informe o e-mail!',
            'dados' => null
        ], 400);
    } elseif (ValidaEmail::validarEmail($email) === false) {
        respostaHttp([
            'msg' => 'E-mail inválido!',
            'dados' => null
        ], 400);
    } else {
        $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
        $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);
        $usuarioComEmailInformado = $usuarioRepositorio->consultarSenhaUsuarioPeloEmail($email);
        if ($usuarioComEmailInformado != false) {
            $senha = $usuarioComEmailInformado->senha;
            // enviar e-mail para o usário contendo a senha dele
            EnvioEmail::enviarEmail($email, 'Se houver um perfil cadastrado com o e-mail informado, em breve você receberá '
            . 'em seu e-mail uma mensagem contendo sua senha!');
        }

        respostaHttp([
            'msg' => 'Se houver um perfil cadastrado com o e-mail informado, em breve você receberá '
            . 'em seu e-mail uma mensagem contendo sua senha!',
            'dados' => null
        ]);
    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao tentar-se recuperar a senha = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se recuperar a senha!: ' . $e->getMessage(),
        'dados' => null
    ], 500);
}