<?php
/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

include dirname(dirname(__FILE__)).'/config.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'functions.php';

$nome = stripslashes($_POST['nome']);
$email = trim($_POST['email']);
$telefone = stripslashes($_POST['telefone']);
$empresa = stripslashes($_POST['empresa']);
$mensagem = stripslashes($_POST['mensagem']);


$error = '';

// Check name

if(!$nome)
{
$error .= 'Por favor introduza o nome.<br />';
}

// Check email

if(!$email)
{
$error .= 'Por favor introduza o email.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Por favor introduza um email válido.<br />';
}

// Check message (length)

if(!$mensagem || strlen($mensagem) < 15)
{
$error .= "Por favor introduza a mensagem. Deve conter 15 caracteres pelo menos.<br />";
}


if(!$error)
{
ini_set("sendmail_from", WEBMASTER_EMAIL); // for windows server
$mail = mail(WEBMASTER_EMAIL, $mensagem,
     "From: ".$nome." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>