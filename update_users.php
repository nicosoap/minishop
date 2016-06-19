<?php
	function update_member($data, $id)
	{
		include("my_connect.php");
		foreach ($data as $key => $value)
			$str .= $key." = '$value', ";
		$str = substr($str, 0, -2);
		mysqli_query($my_connect, "UPDATE users SET $str WHERE user_id = $id");
	}
	function create_data($send)
	{
		$login = htmlspecialchars($send['login']);
		$name = htmlspecialchars($send['name']);
		$addr = htmlspecialchars($send['addr']);
		if (!is_numeric($send['postal_code']) || (strlen($send['postal_code'])) !== 5)
			return (NULL);
		$postal_code = htmlspecialchars($send['postal_code']);
		$country = htmlspecialchars($send['country']);
		$city = htmlspecialchars($send['city']);
		$phone = htmlspecialchars($send['phone']);
		$mail = htmlspecialchars($send['mail']);
		$data = array('login' => $login, 'name' => $name, 'addr' => $addr, 'postal_code' => $postal_code, 'country' => $country, 'city' => $city, 'phone' => $phone, 'mail' => $mail);
		return ($data);
	}	
	function error_occured()
	{
		echo "Veuillez correctement remplir les champs svp !\n";
		exit();
	}
	if (($_POST) == NULL || in_array(NULL, $_POST) || ($data = create_data($_POST)) == NULL)
		error_occured();
	update_member($data, $_POST['user_id']);
	header('Location: dash.php');
?>
