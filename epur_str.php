<?php
	function ft_epur($str) {
		if (isset($str)) {
			$str = str_replace('\+', ' ', $str);
			$str = str_replace('#', ' ', $str);
			while ($str != ($tmp = str_replace('  ', ' ', $str))) {
			 	$str = $tmp;
			 } 
			return trim($str);
		}
	}
?>