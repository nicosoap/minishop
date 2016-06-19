<?php

	session_start();

	if ($_SESSION == NULL || !isset($_SESSION['auth']) || $_SESSION['auth']['is_admin'] == NULL || $_SESSION['auth']['is_logged'] !== TRUE)
	{	
		header('Location: dash.php');
		exit();
	}
	# || $_SESSION['auth']['is_admin'] !== TRUE
?>