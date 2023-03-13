<?php

function respostaHttp($dados = [], $codigoHttp = 200) {
    http_response_code($codigoHttp);

    echo json_encode($dados);
}