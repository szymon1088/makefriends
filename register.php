<?php

session_start();

if(isset($_POST['email']))
{
    //Udana walidacja
    $wszystko_OK=true;

    //Sprawdzenie Nickname'a
    $nick = $_POST['nick'];

    //Sprawdzenie długości nicka
    if ((strlen($nick)<3)||(strlen($nick)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";

    }

    if (ctype_alnum($nick)==false)
    {
        $wszystko_OK=false;
        $_SESSION['e_nick']="Nick może się składać tylko z liter i cyfr bez poslkich znaków";
    }

    //Sprawdź poprawność emaila
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $wszystko_OK=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail";

    }

    //Sprawdz hasło
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ((strlen($password1)<8)||(strlen($password1)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_pass']="Podaj hasło od 8 do 20 znaków";
    }

    if($password1!=$password2)
    {
        $wszystko_OK=false;
        $_SESSION['e_pass']="Podane hasła nie są takie same";
    }

    $pass_hash = password_hash($password1, PASSWORD_DEFAULT);

    //imie
    $name = $_POST['name'];
    if ((strlen($name)<3)||(strlen($name)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_name']="To pole nie może zostać puste!";

    }

    //data
    $birthday = $_POST['birthday'];
    if ((strlen($birthday)<1)||(strlen($birthday)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_birthday']="To pole nie może zostać puste!";

    }

    //miejscowosc
    $city = $_POST['city'];
    if ((strlen($city)<3)||(strlen($city)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_city']="To pole nie może zostać puste!";

    }

    //wojewodztwo
    $provincy = $_POST['provincy'];
    if ((strlen($provincy)<3)||(strlen($provincy)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_provincy']="Nick musi posiadać od 3 do 20 znaków";

    }

    //czy zaakceptowano regulamin
    if (!isset($_POST['regulamin']))
    {
        $wszystko_OK=false;
        $_SESSION['e_regulamin']="Zaakceptuj regulamin!";
    }

    //Bot or not? Oto jest pytanie!
    $sekret = "6Ld8JzoUAAAAAKtKz7PEXB15xDZkwa_ps2m6vd6y";

    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

    $odpowiedz = json_decode($sprawdz);

    if ($odpowiedz->success==false)
    {
        $wszystko_OK=false;
        $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
    }

    //Sprawdzamy czy użytkownik jest już w bazie
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            //czy email juz istnieje?
            $rezultat = $polaczenie->query("SELECT id FROM makefriends WHERE email='$email'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if(($ile_takich_maili)>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail";
            }

            //czy nick jest juz zajety?
            $rezultat = $polaczenie->query("SELECT id FROM makefriends WHERE login='$nick'");


            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_nickow = $rezultat->num_rows;
            if(($ile_takich_nickow )>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Istnieje już gracz o takim nicku!";
            }

            if ($wszystko_OK==true)
            {
                //Wszystko zaliczone, dodajemy ziomka do bazy
                if ($polaczenie->query("INSERT INTO makefriends VALUES(NULL,'$nick','$email','$pass_hash','$name','$birthday','$city','$provincy')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: welcome.php');

                }
                else
                {
                    throw new Exception($polaczenie->error);
                }

            }

            $polaczenie->close();
        }

    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za powstałe niedogodności</span>';

        //echo '<br/> Informacja developerska:'.$e;
    }


}


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>MakeFriends - Registration</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<form method="post">
    Login: <br/><input type="text" name="nick"><br/>
    <?php

    if (isset($_SESSION['e_nick']))
    {
        echo '<div class="register--error">'.$_SESSION['e_nick'].'</div>';
        unset($_SESSION['e_nick']);
    }
    ?>


    E-mail: <br/><input type="text" name="email"><br/>
    <?php

    if (isset($_SESSION['e_email']))
    {
        echo '<div class="register--error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }
    ?>

    Hasło: <br/><input type="password" name="password1"><br/>
    <?php

    if (isset($_SESSION['e_pass']))
    {
        echo '<div class="register--error">'.$_SESSION['e_pass'].'</div>';
        unset($_SESSION['e_pass']);
    }
    ?>

    Powtórz hasło: <br/><input type="password" name="password2"><br/>


    Imie: <br/><input type="text" name="name"<br/>
    <?php

    if (isset($_SESSION['e_name']))
    {
        echo '<div class="register--error">'.$_SESSION['e_name'].'</div>';
        unset($_SESSION['e_name']);
    }
    ?>

    <br/>
    Data urodzin: <br/><input type="date" name="birthday"<br/>
    <?php

    if (isset($_SESSION['e_birthday']))
    {
        echo '<div class="register--error">'.$_SESSION['e_birthday'].'</div>';
        unset($_SESSION['e_birthday']);
    }
    ?>

    <br/>
    Miejscowość: <br/><input type="text" name="city"<br/>
    <?php

    if (isset($_SESSION['e_city']))
    {
        echo '<div class="register--error">'.$_SESSION['e_city'].'</div>';
        unset($_SESSION['e_city']);
    }
    ?>

    <br/>
    Województwo: <br/><input type="text" name="provincy"<br/>
    <br/>
    <?php

    if (isset($_SESSION['e_provincy']))
    {
        echo '<div class="register--error">'.$_SESSION['e_provincy'].'</div>';
        unset($_SESSION['e_provincy']);
    }
    ?>

    <label>
        <input type="checkbox" name="regulamin" />Akceptuje regulamin
    </label>

    <?php
    if (isset($_SESSION['e_regulamin']))
    {
        echo '<div class="register--error">'.$_SESSION['e_regulamin'].'</div>';
        unset($_SESSION['e_regulamin']);
    }
    ?>

    <div class="g-recaptcha" data-sitekey="6Ld8JzoUAAAAABFAzT48CqYqez_0VriJkgofrR-Q"></div>


    <?php
    if (isset($_SESSION['e_bot']))
    {
        echo '<div class="register--error">'.$_SESSION['e_bot'].'</div>';
        unset($_SESSION['e_bot']);
    }
    ?>

    <input type="submit" value="zarejestruj się" /><br/>
    <a href="index.php" style ="color:green;" >Jesteś zarejestrowany? Wróć do okna logowania!</a>



</form>

</body>
</html>