<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    $email_odbiorcy = 'uchanski.pawel@gmail.com';
    $header = 'Reply-To: <'.$_POST['email']."> \r\n";
    $header .= "MIME-Version: 1.0 \r\n";
    $header .= "Content-Type: text/html; charset=UTF-8";
    $wiadomosc = "<p>Dostałes wiadomość od:</p>";
    $wiadomosc .= "<p>Imie i nazwisko: ".$_POST['name']. "</p>";
    $wiadomosc .= "<p>Email: ".$_POST['email']. "</p>";
    $wiadomosc .= "<p>Wiadomość: ".$_POST['message']."</p>";
    $message = "<!doctype html><html><head><meta charset='UTF-8'>".$wiadomosc."</head></html>";
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