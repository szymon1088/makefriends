<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');

	}1
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Make Friends Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img src="assets/loginpanel/peoplefirst.jpg" class="obrazki">
            <img src="assets/loginpanel/peopletwo.jpg">
            <img src="assets/loginpanel/peoplethree.jpg">
            <div class="app__navbar"></div>
            <div class="app__container">
                <?php
                echo '<div class="app__welcome--name">';
                echo "<p>Witaj ".$_SESSION['name'].'!&nbsp;&nbsp;Co u Ciebie słychać?</p>';
                echo '</div>';
                echo '<div class="app__logout">';
                echo  '<a href="logout.php">Wyloguj się!</a>';
                echo '</div>';
                ?>
            </div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>

</body>
</html>