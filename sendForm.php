<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    $email_odbiorcy = 'uchanski.pawel@gmail.com';
    $header = 'Reply-To: <'.$_POST['email']."> \r\n";
    $header .= "MIME-Version: 1.0 \r\n";
    $header .= "Content-Type: text/html; charset=UTF-8";
    $wiadomosc = "Test wysyłania wiadomości";
    $message = "Test wysyłania wiadomości";
    $subject = 'Wiadomosc ze strony Kursly';
    $subject ='=?utf-8?B?'.base64_encode($subject).'?=';

    if(mail($email_odbiorcy, $subject, $message, $header))
    {
        die('Wiadomość została wysłana');
    }
    else
    {
        die('Wiadomość nie została wysłana');
    }
?>