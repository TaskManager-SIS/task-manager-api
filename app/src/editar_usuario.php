<?php

<<<<<<< HEAD
use GerenciadorTarefas\App\Repositorios\UsuarioRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;
use GerenciadorTarefas\App\Utilitarios\ParametroRequisicao;
use GerenciadorTarefas\App\Utilitarios\ValidaEmail;
use GerenciadorTarefas\App\Utilitarios\ValidaFormulario;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $id = ParametroRequisicao::get('id');
    $nome = ParametroRequisicao::get('nome');
    $email = ParametroRequisicao::get('email');
    $senha = ParametroRequisicao::get('senha');
    $ativo = ParametroRequisicao::get('ativo');

    if (!ValidaFormulario::validarFormulario($id, $nome, $email, $senha)) {
        respostaHttp([
            'msg' => 'Informe todos os dados obrigatórios!',
            'dados' => null
        ], 200);
    } elseif (!ValidaEmail::validarEmail($email)) {
        respostaHttp([
            'msg' => 'Informe um e-mail válido!',
            'dados' => null
        ], 200);
    } else {
        $usuarioRepositorio = new UsuarioRepositorio($conexaoBancoDados);
        // buscar usuário pelo id
        $usuarioEditar = $usuarioRepositorio->buscarUsuarioPeloId($id);

        if ($usuarioEditar === false) {
            respostaHttp([
                'msg' => 'Não existe um usuário cadastrado com esse id!',
                'dados' => null
            ], 404);
        } else {
            // buscar um usuário pelo e-mail informado
            $usuarioComEmailInformado = $usuarioRepositorio->buscarIdUsuarioPeloEmail($email);

            if ($usuarioComEmailInformado === false
            || $usuarioComEmailInformado->id === $usuarioEditar->id) {
                $senhaEditar = password_hash($senha, PASSWORD_BCRYPT);

                // pode editar
                if ($usuarioRepositorio->editarUsuario($id, $nome, $email, $senhaEditar, $ativo)) {
                    respostaHttp([
                        'msg' => 'Os dados do usuário foram alterados com sucesso!',
                        'dados' => [
                            'id' => $id,
                            'nome' => $nome,
                            'email' => $email,
                            'senha' => $senha,
                            'ativo' => $ativo
                        ]
                    ], 200);
                } else {
                    respostaHttp([
                        'msg' => 'Ocorreu um erro ao tentar-se editar os dados do usuário!',
                        'dados' => null
                    ], 500);
                }

            } else {
                respostaHttp([
                    'msg' => 'Você não pode utilizar esse e-mail! Informe outro e-mail',
                    'dados' => null
                ], 200);
            }

        }

    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao tentar-se editar os dados do usuário = ' . $e->getMessage() . ' - ' . $e->getLine());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se editar os dados do usuário: ' . $e->getMessage() . ' - ' . $e->getLine(),
=======
use GerenciadorTarefas\App\Utilitarios\Log;

try {
    
} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao tentar-se editar os dados do usuário = ' . $e->getMessage());
    respostaHttp([
        'msg' => '',
>>>>>>> f455e3cdf130b88cddd3d965e5a6d8fa111115e1
        'dados' => null
    ], 500);
}