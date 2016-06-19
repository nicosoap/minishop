<?php
	function create_member($data)
	{
		include("my_connect.php");
		foreach ($data as $key => $value)
		{
			$tmp .= $key.", ";
			$val .= "'$value'".", ";
		}
		$tmp = substr($tmp, 0, -2);
		$val = substr($val, 0, -2);
		mysqli_query($my_connect, "INSERT INTO users ($tmp) VALUES ($val)");
	}
	function create_data($send)
	{
		$login = htmlspecialchars($send['login']);
		$pass =  hash('whirlpool', htmlspecialchars($send['passwd']));
		$name = htmlspecialchars($send['name']);
		$addr = htmlspecialchars($send['addr']);
		if (!is_numeric($send['postal_code']) || (strlen($send['postal_code'])) !== 5)
			return (NULL);
		$postal_code = htmlspecialchars($send['postal_code']);
		$country = htmlspecialchars($send['country']);
		$city = htmlspecialchars($send['city']);
		$phone = htmlspecialchars($send['phone']);
		$mail = htmlspecialchars($send['mail']);
		$data = array('login' => $login, 'passwd' => $pass, 'name' => $name, 'addr' => $addr, 'postal_code' => $postal_code, 'country' => $country, 'city' => $city, 'phone' => $phone, 'mail' => $mail);
		return ($data);
	}	
	function error_occured()
	{
		echo "Veuillez correctement remplir les champs svp !\n";
		exit();
	}
	if (($_POST) == NULL || in_array(NULL, $_POST) || ($data = create_data($_POST)) == NULL)
		error_occured();
	create_member($data);
	echo("Inscription réussie !");
?>
<br /><a href="index.php">Home</a>