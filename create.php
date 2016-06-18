<?php
	if ($_POST[submit]!="OK") {
		echo "ERROR\n";
	} else {
		if (($_POST["login"]!="") && ($_POST["passwd"]!="")) {
			$tmp = ['login' => $_POST[login], 'passwd' => hash("whirlpool", $_POST[passwd])];
			if (file_exists("../htdocs/private/passwd")) {
				$passwd = unserialize(file_get_contents("../htdocs/private/passwd"));
				$i = "non";
				foreach ($passwd as $value) {
					if ($value[login] == $tmp[login]) {
						echo "ERROR\n";
						$i = "oui";
					}
				}
				if ($i === "non") {
					$passwd[]=$tmp;
					file_put_contents("../htdocs/private/passwd", serialize($passwd));
					echo "OK\n";
				}
			} else {
				if (!file_exists("../htdocs/private"))
					mkdir("../htdocs/private", 0777, 1);
				$stmp[] = $tmp;
				file_put_contents("../htdocs/private/passwd", serialize($stmp));
				echo "OK\n";
			}
		} else {
			echo "ERROR\n";
		}
	}
?>