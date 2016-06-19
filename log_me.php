<?php
	session_start();
	include("my_connect.php");
	?><div class="log-bar"><?php
	if (isset($_SESSION['auth']) && ($_SESSION['auth']['is_Logged']) !== FALSE)
	{ ?>
		<a href="dash.php" alt="Mon Dashboard"><?php
		echo $_SESSION['auth']['name'];
		?></a> - <a href="delog.php" alt="Se d&eacut;connecter">Se d&eacute;connecter</a><?php
	} else {
		?><a href="create.html" alt="Cr&eacute;er un compte">Cr&eacute;er un compte</a> - <a href="login.php" alt="Se connecter">Se connecter</a><?
	}?>
	</div>