<?php

use GerenciadorTarefas\App\Utilitarios\Log;

try {
    
} catch (Exception $e) {
    Log::escreverMensagemLog('Erro ao tentar-se editar os dados do usuário = ' . $e->getMessage());
    respostaHttp([
        'msg' => '',
        'dados' => null
    ], 500);
}