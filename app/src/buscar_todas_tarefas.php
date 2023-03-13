<?php

use GerenciadorTarefas\App\Repositorios\TarefaRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;

try {
    $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
    $tarefaRepositorio = new TarefaRepositorio($conexaoBancoDados);
    $tarefas = $tarefaRepositorio->buscarTodasTarefas();
    $quantidadeTarefas = count($tarefas);

    if ($quantidadeTarefas > 0) {

        foreach ($tarefas as $tarefa) {
            $tarefa->usuario_id = intval($tarefa->usuario_id);
        }

    }

    respostaHttp([
        'msg' => 'Existe um total de ' . $quantidadeTarefas . ' tarefas cadastradas no banco de dados!',
        'dados' => $tarefas
    ], 200);
} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao buscar todas as tarefas = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se concultar todos as tarefas!',
        'dados' => null
    ], 500);
}