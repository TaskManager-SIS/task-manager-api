<?php

namespace GerenciadorTarefas\App\Utilitarios;

use PHPMailer\PHPMailer\PHPMailer;

class EnvioEmail
{

    public static function enviarEmail($emailDestinatario, $mensagemEmail) {
        $email = new PHPMailer(true);
        $email->isSMTP(true);
        $email->Host = 'smtp.gmail.com';
        $email->SMTPAuth = true;
        $email->Username = '<inserir aqui o e-mail do projeto>';
        $email->Password = '<inserir aqui a senha de app>';
        $email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $email->Port = 465;
        $email->setFrom('<e-mail do remetente>');
        $email->addAddress('<e-mail do destinatário>');
        $email->Subject = 'Recuperação de senha'; // título do e-mail
        $email->Body = $mensagemEmail; // conteúdo do e-mail
        $email->send();
        // echo 'Enviou e-mail com sucesso!' . PHP_EOL;
    }
}