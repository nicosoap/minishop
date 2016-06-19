<?php
include("my_connect.php");
			$sql = "SELECT * FROM categorie WHERE active = TRUE ORDER BY name ASC";
			if ($my_query = mysqli_query($my_connect, $sql)) {
				while ($value = mysqli_fetch_assoc($my_query)) { ?>
				<a href="index.php?page=categorie&cat=<?php echo $value[name]; ?>"><li><?php echo $value[name]; ?></li></a>
<?php			}
			}
			?>