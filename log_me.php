<?php
	session_start();
	include("my_connect.php");
	?><div class="log-bar"><?php
	if ($_SESSION[loggued_on_user] != "")
	{
		$my_name = mysqli_query($my_connect, "SELECT * FROM users WHERE login= $_SESSION[loggues_on_user]");
		$my_name = mysqli_fetch_array($my_name); ?>
		<a href="dash.php" alt="Mon Dashboard"><?php
		echo $my_name[name];
		?></a> - <a href="logout.php" alt="Se d&eacut;connecter">Se d&eacute;connecter</a><?php
	} else {
		?><a href="create.html" alt="Cr&eacute;er un compte">Cr&eacute;er un compte</a> - <a href="login.html" alt="Se connecter">Se connecter</a><?
	}?>
	</div>