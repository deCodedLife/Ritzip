<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mail.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'заменить!!!';
    $mail->Password   = 'заменить!!!';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('заменить!!!' );
    $mail->addAddress( $requestData->email, 'Joe User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Вы были бриглашены на ritzipcrm.com';
    $mail->Body = 'Ваш пароль для авторизации на <a href="https://ritzipcrm.com/auth">ritzipcrm.com</a> - <b>IDEqRe1X4tPQDubh</b>';
    $mail->AltBody = 'Ваш пароль для авторизации на ritzipcrm.com/auth - IDEqRe1X4tPQDubh';
    $mail->send();

} catch (Exception $e) {

    $API->returnResponse("Message could not be sent. Mailer Error: {$mail->ErrorInfo}") ;

}