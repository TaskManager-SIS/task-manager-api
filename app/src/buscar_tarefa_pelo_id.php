<?php

use GerenciadorTarefas\App\Repositorios\TarefaRepositorio;
use GerenciadorTarefas\App\Utilitarios\ConexaoBancoDados;
use GerenciadorTarefas\App\Utilitarios\Log;

try {
    if (empty($_GET['id'])) {
        respostaHttp([
            'msg' => 'Informe o id da tarefa!',
            'dados' => null
        ], 200);
    } else {
        $idTarefa = intval($_GET['id']);
        $conexaoBancoDados = ConexaoBancoDados::obterConexaoBancoDados();
        $tarefaRepositorio = new TarefaRepositorio($conexaoBancoDados);
        $tarefa = $tarefaRepositorio->buscarTarefaPeloId($idTarefa);

        if ($tarefa === false) {
            respostaHttp([
                'msg' => 'Tarefa não encontrada!',
                'dados' => null
            ], 404);
        } else {
            $tarefa->usuario_id = intval($tarefa->usuario_id);
            respostaHttp([
                'msg' => 'Tarefa encontrada com sucesso!',
                'dados' => $tarefa
            ], 200);
        }

    }
} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao buscar tarefa pelo id = ' . $e->getMessage());
    respostaHttp([
        'msg' => 'Ocorreu um erro ao tentar-se buscar a tarefa pelo id!',
        'dados' => null
    ], 500);
}