<?php
header('Content-Type: text/html; charset=utf-8');

// Inclui as configurações de SMTP
include_once __DIR__ . '"/../../config.php';
include_once __DIR__ . "/../../lib/phpmailer/PHPMailerAutoload.php";

function enviarEmail($email)
{
    global $smtp_host, $smtp_port, $smtp_user, $smtp_password;

    $mailer = new PHPMailer();

    $mailer->SMTPAuth = true;
    $mailer->SMTPDebug = 1;
    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mailer->isSMTP();
    $mailer->Port = $smtp_port;
    $mailer->Host = $smtp_host;
    $mailer->Username = $smtp_user;
    $mailer->Password = $smtp_password;
    $mailer->From = $smtp_user;
    $mailer->FromName = "Slay the Spire - Blog";

    $mailer->AddAddress($email, 'Novo Membro');
    $mailer->Subject = "Novo cadastro para Slay the Spire";

    // Corpo do e-mail
    $mailer->isHTML(true);
    $mailer->Body = '
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #00698f;
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            color: #00698f;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <h1>Novo cadastro para Slay the Spire</h1>
    <p>Novo e-mail para cadastro: ' . $email . ' </p>
    <p>Seja bem-vindo ao nosso blog de Slay the Spire!</p>
    <p>Para mais informações sobre o jogo, acesse nosso blog: <a href="#">Slay the Spire Blog</a></p>
    <p>Se tiver alguma dúvida ou precisar de ajuda, não hesite em entrar em contato conosco.</p>
    <p>Atenciosamente.</p>
';

    if (!$mailer->Send()) {
        $mensagem = 'Erro ao enviar e-mail.';
    } else {
        $mensagem = 'E-mail enviado com sucesso.';
    }
    return $mensagem;
}

$email = $_POST["email"];
if (!$email) header("location: /");
enviarEmail($email);
header("location: /");
