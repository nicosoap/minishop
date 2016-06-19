<?php
	/*include("safety.php");*/
	echo ' 		
		<div class="la-anim-7"></div><div class="central">
 			<p>';
	include("header.php");
	if (file_exists("my_connect.php")) {
		include("my_connect.php");
	}
 	function test_install($my_connect) {
			/*die("L'installation s'est bien pass&eacute;e mais la v&eacuterification a &eacute;chou&eacute;e.\n v&eacute;rifiez que le fichier 'my_connect.php' est pr&eacute;sent &agrave; la base du site et supprimez 'install.php'\n");*/
		/*$my_connect = connect_minishop();*/
		if ($my_connect) {
			die("Installation termin&eacute;e et v&eacute;rifi&eacute;e.<br /> N'oubliez pas de supprimer le fichier 'install.php'<br /> <a href='index.php'>Acc&egraves au minishop</a>");
		} else {
			die("L'installation a &eacute;chou&eacute;e.<br />");
		}
	}
	if ($_GET[reload]==="TRUE") {
		test_install($my_connect);
	} elseif ($_POST['submit']==="Installer") {
		echo "Connexion en cours ...<br />";
		if (file_exists("my_connect.php"))
			unlink("my_connect.php");
		function install_my_connect($my_connect) {
			$my_string = '<?php $my_connect = mysqli_connect("'.$_POST[host].'", "'.$_POST[user].'", "'.$_POST[passwd].'", "'.$_POST[dbname].'"';
			if (isset($_POST[port]) && is_numeric($_POST[port])) {
				$my_string .= ', "'.$_POST['port'].'"';
			}
			$my_string .= "); ?>";
			echo $my_string."\n";
			if (file_put_contents("my_connect.php", $my_string)) {
				echo "Finalisation de l'installation en cours...<br />";
			} else {
				echo "Erreur lors de la finalisation de l'installation.<br />";
			}
			echo "Test de l'instalation, veuillez patienter...<br />";
			if ($my_connect) {
				mysqli_close($my_connect);
			}
			echo "Connexion volontairement interrompue.<br />Reconnexion ";
			$tests = file_exists("my_connect.php");
			while ($tests == FALSE)
				{
					echo ".";
					sleep(0.1);
					$tests = file_exists("my_connect.php");
				}
			echo "<script>window.location = 'install.php?reload=TRUE'</script>" ;
		}
		function create_tables($my_connect) {
			if ($_POST[port]!="") {
				$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[dbname], $_POST[port]);
			} else {
				$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[dbname]);
			}
			if (!$my_connect) {
				die("Connexion &agrave; la base de donn&eacute;e echou&ecute;e: (" . $mycsqli_error($my_connect) . ")\n");
			}
			echo "Connect&eacute; &agrave; la base de donn&eacute;es.<br />";
			$tables[users] = "CREATE TABLE users 
				(
				user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				is_admin BOOLEAN,
				login VARCHAR(30) NOT NULL,
				passwd VARCHAR(1000) NOT NULL,
				name VARCHAR(50),
				addr TEXT,
				postal_code INT(5),
				country VARCHAR(30),
				city  VARCHAR(30),
				phone VARCHAR(20),
				mail VARCHAR(50),
				reg_date TIMESTAMP,
				active BOOLEAN NOT NULL DEFAULT TRUE
				)";
			$tables[categorie] = "CREATE TABLE categorie
				(
				cat_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(60),
				active BOOLEAN NOT NULL DEFAUT TRUE,
				)";
			$tables[produit] = "CREATE TABLE produit
				(
				ref_produit INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				qt_stock INT(6),
				price DECIMAL(9,2),
				description TEXT,
				link_img TEXT,
				product_name TEXT,
				categorie TEXT
				)";
			$tables[panier] = "CREATE TABLE panier
				(
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				key_panier INT(6),
				qt INT(6),
				user_id INT(6) UNSIGNED,
				ref_produit INT(6) UNSIGNED,
				status VARCHAR(30),
				FOREIGN KEY (user_id) REFERENCES users (user_id),
				FOREIGN KEY (ref_produit) REFERENCES produit (ref_produit)
				)";
			foreach ($tables as $key => $sql) {
				echo "Cr&eacute;ation de la table '$key'.<br />";
				if (mysqli_query($my_connect, $sql)) {
					echo "Table '$key' cr&eacute;&eacute;e avec succ&egrave;s.<br />";
				} else {
						die("Erreur lors de la cr&eacute;ation de la table '$key'.<br />".mysqli_error($my_connect));
				}
			}
		};
		if ($_POST[port]!="" && is_numeric($_POST[port])) {
			$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[port]);
		} else {
			$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd]);
		}
		if (!$my_connect) {
			die("Connexion au server echou&ecute;e: (" . $mysqli_connect_error() ."\n");
		}
		echo "Connect&eacute; au serveur de bases de donn&eacute;es.<br />";
		$sql = "CREATE DATABASE $_POST[dbname]";
		if (mysqli_query($my_connect, $sql)) {
			echo "Base de donn&eacute;es cr&eacute;&eacute;e avec succes.<br />";
			create_tables($my_connect);
			install_my_connect($my_connect);
		} else {
			die("Erreur lors de la cr&eacute;tion de la base de donn&eacute;es.<br />". mysqli_error($my_connect) ."<br />");
		}
		mysqli_close($my_connect);
	} else {
?>

 				Bienvenue sur l'installation du minishop. Afin d'initialiser le minishop, veuillez renseigner les informations de connexion au server de bases de donn&eacute;es. 
			</p>
			<p>
 				En cas d'interruption de l'installation avant la fin, rechargez la page "install.php".
			</p>
			<p>
 				En fin d'installation, il est indispensable de supprimer le fichier intall.php.
 			</p>
			<p>
				<table>
					<form action="install.php" method="post">
						<tr><td><input type="text" name="user" placeholder="Login du server sql" /></td></tr>
						<tr><td><input type="password" name="passwd" placeholder="Mot de passe du server sql" /></td></tr>
						<tr><td><input type="text" name="host" placeholder="Adresse du serveur" value="localhost" /></td></tr>
						<tr><td><input type="text" name="dbname" placeholder="Nom de la base de donn&eacute;e" value="minishop"/></td></tr>
						<tr><td><input type="text" name="port" placeholder="Port (facultatif)" /></td></tr>
						<tr><td><input type="submit" name="submit" value="Installer" /></tr>
					</form>
				</table>
<?php
	}
	echo '		</p>
		</div>';
	include("footer.php");
?>