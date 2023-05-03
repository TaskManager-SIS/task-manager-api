<?php

require_once 'vendor/autoload.php';
require_once 'src/configura_requisicoes.php';
require_once 'src/definir_date_time_zone.php';
require_once 'src/resposta_http.php';

use GerenciadorTarefas\App\Utilitarios\ObterEndpoint;

$endpoint = ObterEndpoint::obterEndpoint($_SERVER['REQUEST_URI']);
$metodoHttp = $_SERVER['REQUEST_METHOD'];

if ($metodoHttp === 'POST') {

    switch ($endpoint) {
        case '/usuario':
            // cadastrar usuário
            require_once 'src/cadastrar_usuario.php';
            break;
        case '/tarefa':
            // cadastrar tarefa
            require_once 'src/cadastrar_tarefa.php';
            break;
        case '/usuario/buscar-pelo-email-e-senha':
            // buscar usuário pelo e-mail e senha
            require_once 'src/buscar_usuario_pelo_email_e_senha.php';
            break;
        case '/usuario/recuperar-senha':
            // recuperar senha do usuário
            require_once 'src/recuperar_senha.php';
            break;
        default:
            respostaHttp(['msg' => '404 - Requisição realizada a um endpoint inválido!', 'dados' => null], 404);
            break;
    }

} elseif ($metodoHttp === 'GET') {

    switch ($endpoint) {
        case '/usuario':
            // buscar todos os usuários
            require_once 'src/buscar_todos_usuarios.php';
            break;
        case '/usuario/buscar-pelo-id':
            // buscar usuário pelo id   
            require_once 'src/buscar_usuario_pelo_id.php'; 
            break;
        case '/tarefa':
            // buscar todas as tarefas
            require_once 'src/buscar_todas_tarefas.php';
            break;
        case '/tarefa/buscar-pelo-id':
            // buscar tarefa pelo id
            require_once 'src/buscar_tarefa_pelo_id.php';
            break;
        default:
            respostaHttp(['msg' => '404 - Requisição realizada a um endpoint inválido!', 'dados' => null], 404);
    }

} elseif ($metodoHttp === 'PUT') {

    switch ($endpoint) {
        case '/usuario':
            require_once 'src/editar_usuario.php';
            break;
        case '/tarefa':
            require_once 'src/editar_tarefa.php';
            break;
        case '/tarefa/atualizar-status':
            require_once 'src/atualizar_status_tarefa.php';
            break;
        default:
            respostaHttp(['msg' => '404 - Requisição realizada a um endpoint inválido!', 'dados' => null], 404);
    }

}
