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

        <script src="js/popup.js" defer></script>
        <script src="js/formValidation.js" defer></script>
    </head>
    <body>
        <div class="login_error">
                <div class="topbar">Błędne dane logowania<div class="exit-error">x</div></div>
                <div class="login_again">Zaloguj ponownie</div>
        </div>

        <div class="register-popup">
            <div class="topbar">Rejestracja<div class="exit-register">x</div></div>
            <img src="img/logo.png">
            <form method="POST" id="registry-form">
                <input type="text" class="popup-input" id="reg1" name="name" placeholder="Imie">
                <input type="text" class="popup-input" id="reg2" name="surname" placeholder="Nazwisko"><br>
                <input type="text" class="popup-input" id="reg3" name="email" placeholder="Email"><br>
                <input type="password" class="popup-input" id="reg4" name="password1" placeholder="Hasło">
                <input type="password" class="popup-input" id="reg5" name="password2" placeholder="Potwierdź hasło"><br>
                <input type="text" class="popup-input" id="reg6" name="street" placeholder="Ulica">
                <input type="number" class="popup-input" id="reg7" name="nr" placeholder="Nr"><br>
                <input type="text" class="popup-input" id="reg8" name="postcode" placeholder="Kod pocztowy">
                <input type="text" class="popup-input" id="reg9" name="city" placeholder="Miasto"><br>
                <input type="checkbox" id="check-terms"> Akceptuję regulamin korzystania z usług<br>
                <input type="submit" class="submit_button" value="Zarejestruj">
                <br><small></small>
            </form>
            <?php
                require_once "connect.php";

                if($connect->connect_errno!=0)
                {
                    // echo "Error: ".$connect->connect_errno;
                    echo "<br></nr>Błąd bazy danych";
                }
                else
                {
                    echo "Połączenie nawiązane";

                    @$register_name = $_POST['name'];
                    @$register_surname = $_POST['surname'];
                    @$register_email = $_POST['email'];
                    @$register_password = $_POST['password'];
                    @$register_street = $_POST['street'];
                    @$register_number = $_POST['nr'];
                    @$register_postcode = $_POST['postcode'];
                    @$register_city = $_POST['city'];


                }
            ?>
        </div>

        <div class="login-popup">
            <div class="topbar">Logowanie<div class="exit-login">x</div></div>
            <img src="img/logo.png">
            <form method="POST">
                <input type="text" class="popup-input" id="log1" name="form_email" placeholder="Email"><br>
                <input type="password" class="popup-input" id="log2" name="form_password" placeholder="Hasło"><br>
                <input type="submit" class="submit_button" id="submit_login" value="Zaloguj">
            </form>

            <?php
                require_once "connect.php";

                if($connect->connect_errno!=0)
                {
                    // echo "Error: ".$connect->connect_errno;
                    echo "<br></nr>Błąd bazy danych";
                }
                else
                {
                    echo "Połączenie nawiązane";

                    @$login_email = $_POST['form_email'];
                    @$login_password = $_POST['form_password'];

                    $sql = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password'";

                    if($rezultat = @$connect->query($sql))
                    {
                        $zalogowany = false;

                        $users_number = $rezultat->num_rows;
                        if($users_number>0)
                        {
                            header('Location: login.php');
                            $zalogowany = true;
                        }
                        else
                        {
                            if($zalogowany == false && @$_POST['form_email'] != null)
                            {
                                // Wyświetlanie okna błędu logowania po wpisaniu błędnych danych w popupie logowania
                                echo '<script>(function(){',
                                    'let login_error_popup = document.querySelector(".login_error");',
                                    'login_error_popup.style.display="block";',
                                '}());</script>';

                            }
                        }
                    }
                }
            ?>
        </div>

        <!-- Testing ksangjkaosngakjlmnsalkm -->
        <!-- <script>
                (function(){
                    let login_error_popup = document.querySelector(".login_error");
                    login_error_popup.style.display="block";
                }());
        </script> -->

        <!-- ksngaksngmasngam -->

        <div class="all">
            <div class="sekcja1_all">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="sekcja1_lewo">
                                <a href="/iai"><img src="img/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="sekcja1_prawo">
                                <div class="button" id="register">Rejestracja</div>
                                <div class="button" id="login">Logowanie</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sekcja2_all">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="sekcja2">
                                <span>Kolejna platforma z kursami,<br> ale... lepsza.</span>
                            </div>
                            <div class="sekcja2_button">
                                <div class="button_pink" id="register">Zarejestruj się!</div>
                            </div>
                            <div class="sekcja2_img">
                                <img src="img/main_img.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>

    </body>
</html>