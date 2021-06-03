<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodawanie środków</title>
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
        <div id="added_cash">
            <div class="topbar">Środki dodane</div>
            <h5><br><br>Środki zostały dodane do Twojego portfela<br></h5>
            <a href="panel.php"><button class="cash_submit">Ok!</button></a>
        </div>
        <?php
        session_start();
        require_once "connect.php";

        if($connect->connect_errno!=0)
        {
            // echo "Error: ".$connect->connect_errno;
            echo "<br></nr>Błąd bazy danych";
        }
        else
        {
            @$current_user = $_SESSION["user_id"];
            // echo "Połączenie nawiązane";
            @$sql = "SELECT * FROM users WHERE id_user='$current_user'";

            if($rezultat = @$connect->query($sql))
            {
                while($row = mysqli_fetch_assoc($rezultat))
                {
                    $currentCash = $row['wallet'];
                    $addCash = $_POST["addCashValue"];

                    $newWallet = $currentCash + $addCash;

                    $zapytanie = "update users set wallet = '$newWallet' where id_user = '$current_user'";

                    $result = $connect->query($zapytanie);
                    $_POST["addCashValue"] = 0;
                }
            }
        }

    ?>

    </body>
    </html>