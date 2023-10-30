<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ( $requestData->context->form == "invite" ) {

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'mail.ritzipcrm.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bril-holding@ritzipcrm.com';
        $mail->Password   = 'pZ1wR5tR6v';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('bril-holding@ritzipcrm.com' );
        $mail->addAddress( $requestData->email, 'User');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Вы были бриглашены на ritzipcrm.com';
        $mail->Body = 'Ваш пароль для авторизации на <a href="https://ritzipcrm.com/auth">ritzipcrm.com</a> -' . $requestData->password;
        $mail->AltBody = 'Ваш пароль для авторизации на ritzipcrm.com - ' . $requestData->password;
        $mail->send();

    } catch (Exception $e) {

        $API->returnResponse("Message could not be sent. Mailer Error: {$mail->ErrorInfo}") ;

    }

}