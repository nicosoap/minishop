<?php
	session_start();
	if ($_SESSION[actual_page]!=="login") {
		if ($_SESSION[auth][logged_in]) {
			switch ($_SESSION[goto_at_end]) {
				case 'homepage':
					header('Location: index.php');
					break;
				case 'dashboard':
					header('Location: dash.php');
					break;
				default:
					header('Location: index.php');
					break;
			}
		} elseif (!$_SESSION[actual_page])
			$_SESSION[goto_at_end]="homepage";
		if ($_SESSION[actual_page]==="login_fail") {
			$_SESSION[actual_page]="login";
		echo $_SESSION[alert].'<br /><form action="login.php" method="post">
	<input type="text" name="login" placeholder="Login" required/>
	<input type="password" name="passwd" placeholder="Mot de passe" required/>
	<input type="submit" name="submit" value="OK" required/>
	</form>';
	die();
		} else
			$_SESSION[goto_at_end]=$_SESSION[actual_page];
		$_SESSION[actual_page]="login";
		echo '<form action="login.php" method="post">
	<input type="text" name="login" placeholder="Login" required/>
	<input type="password" name="passwd" placeholder="Mot de passe" required/>
	<input type="submit" name="submit" value="OK" required/>
	</form>';
	} elseif ($_SESSION[actual_page]==="login") {
	$_SESSION['auth']['is_logged'] = FALSE;
	function check_passwd($login, $pass)
	{
		include("my_connect.php");
		$ret = mysqli_query($my_connect, "SELECT * FROM users WHERE login = '$login' AND passwd = '$pass' LIMIT 1");
		if ($ret != NULL)
		{
			$result = mysqli_fetch_assoc($ret);
			if (!$result)
			{
				$_SESSION[actuel_page]="login_fail";
				$_SESSION[alert]="Veuillez remplir les champs svp !<br />";
				header('Location: login.php'); 
			}
			else {
				$_SESSION['auth']['user_id'] = $result['user_id'];
				$_SESSION['auth']['is_admin'] = $result['is_admin'];
				$_SESSION['auth']['login'] = $result['login'];
				$_SESSION['auth']['name'] = $result['name'];
				$_SESSION['auth']['addr'] = $result['addr'];
				$_SESSION['auth']['postal_code'] = $result['postal_code'];
				$_SESSION['auth']['country'] = $result['country'];
				$_SESSION['auth']['city'] = $result['city'];
				$_SESSION['auth']['phone'] = $result['phone'];
				$_SESSION['auth']['mail'] = $result['mail'];
				$_SESSION['auth']['is_logged'] = TRUE;
				if ($res[is_admin] === TRUE) 
					header('Location: dash.php');
				$_SESSION[actual_page]="logged_in";
					header('Location: login.php');
			}
		}
		return (NULL);
		
	}
	function error_occured()
	{
		$_SESSION[actuel_page]="login_fail";
		$_SESSION[alert]="Veuillez remplir les champs svp !<br />";
		header('Location: login.php'); 
		exit();
	}
	if (($_POST) == NULL || in_array(NULL, $_POST))
		error_occured();
	$login = htmlspecialchars($_POST['login']);
	$pass = hash('whirlpool', htmlspecialchars($_POST['passwd']));
	if (($res = check_passwd($login, $pass)) == NULL)
		error_occured();
}
?>