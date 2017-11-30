<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['pass'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$pass = $_POST['pass'];
        $email = $_POST['email'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM makefriends WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($pass, $wiersz['password']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['login'] = $wiersz['login'];
                    $_SESSION['email'] = $wiersz['email'];
                    $_SESSION['name'] = $wiersz['name'];



                    unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: app.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span class="home__login--error">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span class="home__login--error">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>