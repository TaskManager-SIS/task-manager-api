<?php

use GerenciadorTarefas\App\Repositorios\TarefaRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;
use GerenciadorTarefas\App\Utilitarios\ParametroRequisicao;
use GerenciadorTarefas\App\Utilitarios\ValidaFormulario;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $titulo = ParametroRequisicao::get('titulo');
    $descricao = ParametroRequisicao::get('descricao');
    $dataCadastro = date('Y-m-d H:i:s');
    $usuarioId = ParametroRequisicao::get('usuarioId');

    if (!ValidaFormulario::validarFormulario($titulo, $descricao, $usuarioId)) {
        respostaHttp([
            'msg' => 'Informe todos os dados obrigatórios!',
            'dados' => null
        ], 400);
    } else {
        $usuarioId = intval($usuarioId);
        $tarefaRepositorio = new TarefaRepositorio($conexaoBancoDados);

        if ($tarefaRepositorio->cadastrarTarefa($titulo, $descricao, $dataCadastro, $usuarioId)) {
            $idTarefaCadastrada = intval($conexaoBancoDados->lastInsertId());
            respostaHttp([
                'msg' => 'Tarefa cadastrada com sucesso!',
                'dados' => [
                    'id' => $idTarefaCadastrada,
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'status' => 'Em andamento',
                    'dataCadastro' => $dataCadastro,
                    'usuarioId' => $usuarioId
                ]
            ], 201);
        } else {
            respostaHttp([
                'msg' => 'Ocorreu um erro ao tentar-se cadastrar a tarefa!',
                'dados' => null
            ], 500);
        }

    }

} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao cadastrar tarefa = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se cadastrar a tarefa!',
        'dados' => null
    ], 500);
}