<?php

	session_start();
	include ("protec_admin.php");

	function create_article($data)
	{
		include("my_connect.php");
		foreach ($data as $key => $value)
		{
			$tmp .= $key.", ";
			$val .= "'$value'".", ";
		}
		$tmp = substr($tmp, 0, -2);
		$val = substr($val, 0, -2);
		mysqli_query($my_connect, "INSERT INTO produit ($tmp) VALUES ($val)");
	}
	function create_data($send)
	{
		$product_name = htmlspecialchars($send['product_name']);
		if (!is_numeric($send['qt_stock']) || !is_numeric($send['price']))
			return (NULL);
		$qt_stock = htmlspecialchars($send['qt_stock']);
		$price = htmlspecialchars($send['price']);
		$description = htmlspecialchars($send['description']);
		$link_img = htmlspecialchars($send['link_img']);
		$categorie = htmlspecialchars($send['categorie']);
		$data = array('product_name' => $product_name, 'qt_stock' => $qt_stock, 'price' => $price, 'description' => $description, 'link_img' => $link_img, 'categorie' => $categorie);
		return ($data);
	}	
	function error_occured()
	{
		echo "Veuillez correctement remplir les champs svp !\n";
		exit();
	}

	if (($_POST) == NULL || in_array(NULL, $_POST) || ($data = create_data($_POST)) == NULL)
		error_occured();
	create_article($data);
	header('Location: admin_prod.php');
?>