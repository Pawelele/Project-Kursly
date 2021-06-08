<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Kursly</title>
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

        <script src="js/addcash.js" defer></script>
    </head>
    <?php
    session_start();
    if($_SESSION["session_login"]==true)
    {
        ?>

        <body>
            <!-- Popup for adding money to wallet -->
            <div id="cash_popup">
                    <div class="topbar">Dodawanie środków<div class="exit-cash">x</div></div>
                    <form action="money.php" method="POST">
                        <input type="number" placeholder="Podaj kwotę" class="cash_input" name="addCashValue"> zł<br>
                        <input type="submit" class="cash_submit" value="Dodaj">
                    </form>
            </div>

            <div class="pink"></div>
            <div class="sekcja1_all2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sekcja1_lewo2">
                                <a href="panel.php"><img src="img/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="sekcja1_prawo2">
                                <div class="menu">
                                    <ul>
                                        <li><form method="POST">
                                            <input type="submit" name="logout" value="Wyloguj" class="menu_option">
                                        </form></li>
                                        <li><a href="contact.php" class="menu_option">Kontakt</a></li>
                                        <li><a href="orders.php" class="menu_option">Moje kursy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                            @$current_user = $_SESSION["user_id"];

                            require_once "connect.php";

                            if($connect->connect_errno!=0)
                            {
                                // echo "Error: ".$connect->connect_errno;
                                echo "<br></nr>Błąd bazy danych";
                            }
                            else
                            {
                                // echo "Połączenie nawiązane";
                                @$sql = "SELECT * FROM users WHERE id_user='$current_user'";

                                if($rezultat = @$connect->query($sql))
                                {
                                    while($row = mysqli_fetch_assoc($rezultat))
                                    {
                                        $name = $row['name'];
                                        $surname = $row['surname'];
                                        $cash = $row['wallet'];
                                    }
                                }

                                echo '<div class="user_panel">';
                                echo '<p id="user_panel_name">', $name, ' ', $surname, '</p>';
                                echo '<p id="user_panel_cash">Stan konta: ',$cash,' zł' ,'</p>';
                                echo '<p id="user_panel_addCash">Dodaj środki</p>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="sekcja2_all2">
                    <!-- Contact form -->
                    <form method="post" action="sendForm.php">
                        <input type="text" name="name" class="popup-input" placeholder="Imię i naziwsko" required><br>
                        <input type="text" name="email" class="popup-input" placeholder="Email" required><br>
                        <input type="text" name="message" class="popup-input" placeholder="Wiadomość" required><br>

                        <input type="submit" class="submit_button" value="Wyślij">
                    </form>

            </div>

            <!-- function for loging out -->
            <?php
                if(isset($_POST['logout']))
                {
                    $_SESSION = array();
                    session_destroy();

                    echo "<script type=\"text/javascript\">
                    window.setTimeout(\"window.location.replace('index.php');\",1);
                    </script>";
                }
            ?>
        </body>

        <?php
            }
            else
            {

                echo "<script type=\"text/javascript\">
                window.setTimeout(\"window.location.replace('index.php');\",1);
                </script>";

            }
        ?>