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
        <!-- Aditional id for script to open only this popup -->
        <div class="register_error">
                <div class="topbar">Uzytkownik istnieje juz w bazie<div class="exit-error-register">x</div></div>
                <div class="register_login">Zaloguj</div>
        </div>

        <div class="register-popup">
            <div class="topbar">Rejestracja<div class="exit-register">x</div></div>
            <img src="img/logo.png">
            <form method="POST" id="registry-form">
                <input type="text" class="popup-input" id="reg1" name="name" placeholder="Imie" required>
                <input type="text" class="popup-input" id="reg2" name="surname" placeholder="Nazwisko" required><br>
                <input type="text" class="popup-input" id="reg3" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
                <input type="password" class="popup-input" id="reg4" name="password1" placeholder="Hasło" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Musi zawierać co najmniej jeden numer, jedną duzą literę, jedną małą oraz co najmniej 8 znaków" required>
                <input type="password" class="popup-input" id="reg5" name="password2" placeholder="Potwierdź hasło" required><br>
                <input type="text" class="popup-input" id="reg6" name="street" placeholder="Ulica" required>
                <input type="number" class="popup-input" id="reg7" name="nr" placeholder="Nr" required><br>
                <input type="text" class="popup-input" id="reg8" name="postcode" placeholder="Kod pocztowy" pattern="[0-9]{2}\-[0-9]{3}" title="Podaj kod w formacie XX-XXX" required>
                <input type="text" class="popup-input" id="reg9" name="city" placeholder="Miasto" required><br>
                <input type="checkbox" id="check-terms" required> Akceptuję regulamin korzystania z usług<br>
                <input type="submit" class="submit_button" value="Zarejestruj">
                <br><small></small>
            </form>
            <?php
                session_start();
                require_once "connect.php";

                if(@$_SESSION["session_login"]==true)
                {
                    header('Location: panel.php');
                }

                if($connect->connect_errno!=0)
                {
                    // echo "Error: ".$connect->connect_errno;
                    echo "<br></nr>Błąd bazy danych";
                }
                else
                {
                    $register_showed = false;
                    // echo "Połączenie nawiązane";

                    @$register_name = $_POST['name'];
                    @$register_surname = $_POST['surname'];
                    @$register_email = $_POST['email'];
                    @$register_password = $_POST['password1'];
                    @$register_street = $_POST['street'];
                    @$register_number = $_POST['nr'];
                    @$register_postcode = $_POST['postcode'];
                    @$register_city = $_POST['city'];
                    @$wallet = 50;

                    @$register_password_hash = password_hash("$register_password", PASSWORD_DEFAULT);

                    // Check email in database. If existing don't register new user and show information
                    @$sql_check_email = "SELECT * FROM users WHERE email='$register_email'";

                    if($rezultat_check = @$connect->query($sql_check_email))
                    {
                        @$existing_user;
                        $users_number_reg = $rezultat_check->num_rows;
                        if($users_number_reg>0)
                        {
                            while($row = mysqli_fetch_assoc($rezultat_check))
                            {
                                $existing_user = $row['email'];
                            }
                            if($register_showed == false)
                            {
                                echo '<script>(function(){',
                                    'let register_error_popup1 = document.querySelector(".register_error");',
                                    'register_error_popup1.style.display="block";',
                                '}());</script>';

                            }
                            else
                            {
                                $register_showed = true;
                            }

                        }
                        else
                        {
                            $connect->query('SET NAMES utf8');
                            $connect->query('SET CHARACTER_SET utf8_unicode_ci');

                            if(empty($register_name))
                            {
                            }
                            else
                            {
                                $zapytanie = "insert into users (password, name, surname, email, street, house_number, zip_code, city, wallet) values ('".$register_password."','".$register_name."', '".$register_surname."', '".$register_email."', '".$register_street."', '".$register_number."', '".$register_postcode."', '".$register_city."', '".$wallet."')";

                                $result = $connect->query($zapytanie);
                                $connect -> close();
                            }
                        }
                    }
                }
            ?>
        </div>

        <div class="login-popup">
            <div class="topbar">Logowanie<div class="exit-login">x</div></div>
            <img src="img/logo.png">
            <form method="POST">
                <input type="text" class="popup-input" id="log1" name="form_email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
                <input type="password" class="popup-input" id="log2" name="form_password" placeholder="Hasło" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Musi zawierać co najmniej jeden numer, jedną duzą literę, jedną małą oraz co najmniej 8 znaków" required><br>
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
                    // echo "Połączenie nawiązane";
                    @$login_email = $_POST['form_email'];
                    @$login_password = $_POST['form_password'];
                    echo $login_email;

                    @$login_password_hash = password_hash("$login_password", PASSWORD_DEFAULT);

                    @$sql = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password'";

                    if($rezultat = @$connect->query($sql))
                    {
                        $zalogowany = false;

                        $users_number = $rezultat->num_rows;
                        if($users_number>0)
                        {
                            header('Location: panel.php');
                            $zalogowany = true;
                            $_SESSION["session_login"] = true;

                            while($row = mysqli_fetch_assoc($rezultat))
                            {
                                $_SESSION["user_id"] = $row['id_user'];
                            }
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