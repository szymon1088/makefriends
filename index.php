<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: app.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
	<title>Make Friends</title>
</head>

<body>
<div class="container-fluid">
    <img src="assets/bg/mkbg.png" class="bgimg">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="login__panel__container login__container__home"></div>
            <form action="login.php" method="post">
                <input type="text" name="login" class="home__input--login" placeholder="Wpisz swój login"/> <br />
                <input type="password" name="pass" class="home__input--password" placeholder="Wpisz swoje hasło"/> <br /><br />
                <input type="submit" value="Zaloguj się" class="home__input__button--submit"/>

            </form>
            <a href="register.php" class="register__title">Nie masz konta? Zarejestruj się za darmo!</a>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
	<br /><br />

<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>
</html>