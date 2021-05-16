<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Rejestracja</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Paweł Uchański">
        <meta name="description" content="Platofrma z kursami online.">
        <meta name="keywords" content="Kursy, online, kursy online, kurs, html, css, js, javascript, nauka, nauka programowania">
        <link rel="stylesheet" href="style.css" type="text/css">

        <!-- Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Bootstrap end -->

        <!-- Czcionka -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Czcionka end -->

    </head>
    <body>

    <?php
        $host = "localhost";
        $db_user="IA_agent";
        $db_password = "Inzynieria_Aplikacji_123";
        $db_name = "IA_Database";

        require_once "register.php";

        $connect = @new mysqli($host, $db_user, $db_password, $db_name);

        if($connect->connect_errno!=0)
        {
            echo "Error: ".$connect->connect_errno;
        }
        else
        {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $street = $_POST['street'];
            $number = $_POST['nr'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];

            

        }
    ?>

        <div class="loader"></div>

    </body>
</html>