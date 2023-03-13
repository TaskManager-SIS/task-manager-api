<?php

use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;
use GerenciadorTarefas\App\Utilitarios\ParametroRequisicao;
use GerenciadorTarefas\App\Utilitarios\ValidaEmail;
use GerenciadorTarefas\App\Utilitarios\ValidaFormulario;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $nome = ParametroRequisicao::get('nome');
    $email = ParametroRequisicao::get('email');
    $senha = ParametroRequisicao::get('senha');

    if (!ValidaFormulario::validarFormulario($nome, $email, $senha)) {
        // dados inválidos
        respostaHttp([
            'msg' => 'Informe todos os dados obrigatórios!',
            'dados' => null
        ], 400);
    } elseif (!ValidaEmail::validarEmail($email)) {
        respostaHttp([
            'msg' => 'E-mail inválido!',
            'dados' => null
        ], 400);
    } else {
        $senha = md5($senha);
        $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);

        // verificando se já existe algum usuário cadastrado com o e-mail informado
        if ($usuarioRepositorio->verificarSeExisteUsuarioCadastradoComEmailInformado($email)) {
            // já existe um usuário cadastrado com o e-mail informado
            respostaHttp([
                'msg' => 'Informe outro e-mail!',
                'dados' => null
            ], 400);
        } else {
            // ainda não existe um usuário cadastrado com o e-mail informado
            
            if ($usuarioRepositorio->cadastrarUsuario($nome, $email, $senha)) {
                // usuário cadastrado com sucesso
                respostaHttp([
                    'msg' => 'Usuário cadastrado com sucesso!',
                    'dados' => [
                        'id' => intval($conexaoBancoDados->lastInsertId()),
                        'nome' => $nome,
                        'email' => $email,
                        'senha' => $senha,
                        'ativo' => true
                    ]
                ], 201);
            } else {
                // ocorreu um erro ao cadastrar o usuário
                respostaHttp([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar o usuário!',
                    'dados' => null
                ], 500);
            }

        }

    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro cadastro de usuários = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se cadastrar o usuário!',
        'dados' => null
    ], 500);
}