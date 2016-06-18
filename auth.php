<?php
function auth($login, $passwd) {
	if (file_exists("../htdocs/private/passwd")) {
		$newpw = hash("whirlpool", $passwd);
		$data = unserialize(file_get_contents("../htdocs/private/passwd"));
		$i = "non";
		foreach ($data as $key =>$value) {
			if (($login === $value[login]) && ($newpw === $value[passwd]))
				return TRUE;
		}
	}
	return FALSE;
}
?>