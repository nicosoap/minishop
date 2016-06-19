<?php

	session_start();
	include ("protec_admin.php");
	
	function create_categ($name)
	{
		include("my_connect.php");
		mysqli_query($my_connect, "INSERT INTO categorie (name) VALUES ('$name')");
	}
	function error_occured()
	{
		echo "Veuillez correctement remplir les champs svp !\n";
		exit();
	}
	if (($_POST) == NULL || in_array(NULL, $_POST))
		error_occured();
	create_categ(htmlspecialchars($_POST['name']));
	header('Location: admin_categ.php');
?>