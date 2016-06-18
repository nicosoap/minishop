<?php
	if ($_POST[submit]!="OK") {
		echo "ERROR\n";
	} else {
		if (($_POST["login"]!="") && ($_POST["oldpw"]!="") && ($_POST["newpw"]!="")) {
			if (file_exists("../htdocs/private/passwd")) {
				$oldpw = hash("whirlpool", $_POST[oldpw]);
				$newpw = hash("whirlpool", $_POST[newpw]);
				$passwd = unserialize(file_get_contents("../htdocs/private/passwd"));
				$i = "non";
				foreach ($passwd as $key =>$value) {
					if (($_POST[login] === $value[login]) && ($oldpw === $value[passwd])) {
						$passwd[$key][passwd] = $newpw;
						$i = "oui";
					}
				}
				if ($i === "oui") {
					file_put_contents("../htdocs//private/passwd", serialize($passwd));
					echo "OK\n";
				} else {
					echo "ERROR\n";
				}
			} else {
				echo "ERROR\n";
			}
		} else {
			echo "ERROR\n";
		} 
	}
?>