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
                                    <a href="panel.php" class="menu_option">Strona główna</a>
                                    <a href="kursy.php" class="menu_option" id="xd">Moje kursy</a>
                                    <form method="POST">
                                        <input type="submit" name="logout" value="Wyloguj" class="menu_option" id="xd2">
                                    </form>
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
                    <!-- Listing courses from database -->
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
                                @$sql = "SELECT * FROM orders join courses on orders.id_course = courses.id_course where id_user = $current_user";

                                if($rezultat = @$connect->query($sql))
                                {
                                    while($row = mysqli_fetch_assoc($rezultat))
                                    {
                                        $course_id = $row['id_course'];
                                        $course_img = $row['img'];
                                        $course_name = $row['name'];
                                        $course_description = $row['description'];
                                        $course_price = $row['price'];


                                        echo    '<div class="course_list">';
                                        echo    '<div class="container">';
                                        echo        '<div class="row">';
                                        echo            '<div class="col-md-2">';
                                        echo                '<div class="sekcja2_lewo2">';
                                        echo                    '<img src="',
                                        $course_img ,'">';
                                        echo                '</div>';
                                        echo            '</div>';
                                        echo            '<div class="col-md-8">';
                                        echo                '<div class="sekcja2_srodek2">';
                                        echo                    '<p id="course_list_title">',$course_name,'</p>';
                                        echo                '</div>';
                                        echo            '</div>';
                                        echo            '<div class="col-md-2">';
                                        echo                '<div class="sekcja2_prawo2">';
                                        echo                    '<p id="course_list_price">&#x2714;</p>';
                                        echo                '</div>';
                                        echo            '</div>';
                                        echo        '</div>';
                                        echo    '</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                        ?>
                        <?php
                            if(isset($_POST['submit']))
                            {
                                // issue with wallet status
                                sleep(2);
                                $logged_user = $_SESSION["user_id"];
                                $check = false;


                                @$sql_bought_courses = "SELECT * FROM orders where id_user = $logged_user";
                                if($rezultat_bought= @$connect->query($sql_bought_courses))
                                {
                                    while($row = mysqli_fetch_assoc($rezultat_bought))
                                    {
                                        if($row['id_course'] == @$_POST['ordered'])
                                        {
                                            $check = true;
                                        }
                                    }
                                }
                                // Add course only if user don't have one
                                if($check == false)
                                {
                                    // Checking wallet status before order
                                    $wallet_status;
                                    @$sql_wallet = "SELECT * FROM users where id_user = $logged_user";
                                    if($rezultat_wallet = @$connect->query($sql_wallet))
                                    {
                                        while($row = mysqli_fetch_assoc($rezultat_wallet))
                                        {
                                            $wallet_status = $row['wallet'];
                                        }
                                    }
                                    // Match the course from database, and place order
                                    @$sql_order = "SELECT * FROM courses";

                                    if($rezultat = @$connect->query($sql_order))
                                    {
                                        while($row = mysqli_fetch_assoc($rezultat))
                                        {
                                            $actual_course = $row['id_course'];

                                            if($actual_course == @$_POST['ordered'])
                                            {
                                                $course_price = $row['price'];

                                                if($wallet_status > $course_price)
                                                {
                                                    $zapytanie = "insert into orders (id_user, id_course, price) values ('".$logged_user."','".$actual_course."', '".$course_price."')";

                                                    $result = $connect->query($zapytanie);

                                                    $new_wallet = $wallet_status - $course_price;

                                                    $zapytanie_cash = "update users set wallet = $new_wallet";

                                                    $result_cash = $connect->query($zapytanie_cash);

                                                    $_POST = array();
                                                }
                                                else
                                                {
                                                    echo '<script>(function(){',
                                                        'let noMoneyPopupHtml = document.querySelector("#noMoney_popup");',
                                                        'noMoneyPopupHtml.style.display="block";',
                                                        '}());</script>';
                                                }
                                            }
                                        }
                                    }
                                }
                                else if($check == true)
                                {
                                    echo '<script>(function(){',
                                        'let courseBoughtPopupHtml = document.querySelector("#courseBought_popup");',
                                        'courseBoughtPopupHtml.style.display="block";',
                                        '}());</script>';
                                }
                            }
                        ?>
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