<?php
	/*include("safety.php");*/
	echo ' 		<div class="central">
 			<p>';
	include("header.php");
	if ($_POST['submit']==="Installer") {
		echo "Connexion en cours ...\n";
		$my_string='<php $my_connect = mysqli_connect("'.$_POST[host].'", "'.$_POST[user].'", "'.$_POST[passwd].'", "'.$_POST[dbname];
		if (isset($_POST[port])) {
			$my_string.=', "'.$_POST['port'];
		}
		$my_string.=");\n";

			echo $my_string."\n";
		function install_my_connect() {
			$my_string = '<php \$my_connect = mysqli_connect("'.$_POST[host].'", "'.$_POST[user].'", "'.$_POST[passwd].'", "'.$_POST[dbname].'"';
			if (isset($_POST[port])) {
				$my_string .= ', "'.$_POST['port'].'"';
			}
			$my_string .= ");\n?>";
			echo $my_string."\n";
			if (file_put_contents("my_connect.php", $my_string)) {
				echo "Finalisation de l'installation en cours...\n";
			} else {
				echo "Erreur lors de la finalisation de l'installation.\n";
			}
			echo "Test de l'instalation, veuillez patienter...\n";
			if ($my_connect) {
				mysqli_close($my_connect);
			} else {
				echo "Connection interrompue.\n";
			}
			include("my_connect.php");
			if (!$my_connect) {
				echo "L'installation a &eacute;chou&eacute;e.\n";
			} else {
				echo "Installation termin&eacute;e et v&eacute;rifi&eacute;e.\n N'oubliez pas de supprimer le fichier 'install.php'";
			}
		}
		function create_tables() {
			if ($_POST[port]!="") {
				$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[dbname], $_POST[port]);
			} else {
				$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[dbname]);
			}
			if (!$my_connect) {
				die("Connection &agrave; la base de donn&eacute;e echou&ecute;e: (" . $mycsqli_error($my_connect) . ")\n");
			}
			echo "Connect&eacute; &agrave; la base de donn&eacute;es.\n";
			$tables[users] = "CREATE TABLE users 
				(
				user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				is_admin INT(1),
				login VARCHAR(30) NOT NULL,
				passwd VARCHAR(1000) NOT NULL,
				name VARCHAR(50), adrr TEXT,
				postal_code INT(5),
				country VARCHAR(30),
				city  VARCHAR(30),
				phone VARCHAR(20),
				email VARCHAR(50),
				reg_date TIMESTAMP
				)";
			$tables[produit] = "CREATE TABLE produit
				(
				ref_produit INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				qt_stock INT(6),
				price DECIMAL(9,2),
				description TEXT,
				link_img TEXT
				)";
			$tables[panier] = "CREATE TABLE panier
				(
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				key_panier INT(6),
				qt INT(6),
				user_id INT(6) UNSIGNED,
				ref_produit INT(6) UNSIGNED,
				FOREIGN KEY (user_id) REFERENCES users (user_id),
				FOREIGN KEY (ref_produit) REFERENCES produit (ref_produit)
				)";
			foreach ($tables as $key => $sql) {
				echo "Cr&eacute;ation de la table '$key'.\n";
				if (mysqli_query($my_connect, $sql)) {
					echo "Table '$key' cr&eacute;&eacute;e avec succ&egrave;s.\n";
				} else {
						die("Erreur lors de la cr&eacute;ation de la table '$key'.\n".mysqli_error($my_connect));
				}
			}
		};
		if ($_POST[port]!="" && is_numeric($_POST[port])) {
			$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd], $_POST[port]);
		} else {
			$my_connect = mysqli_connect($_POST[host], $_POST[user], $_POST[passwd]);
		}
		if (!$my_connect) {
			die("Connection au server echou&ecute;e: (" . $mysqli_connect_error() ."\n");
		}
		echo "Connect&eacute; au serveur de bases de donn&eacute;es.\n";
		$sql = "CREATE DATABASE $_POST[dbname]";
		if (mysqli_query($my_connect, $sql)) {
			echo "Base de donn&eacute;es cr&eacute;&eacute;e avec succes.\n";
			create_tables();
			install_my_connect();
		} else {
			die("Erreur lors de la cr&eacute;tion de la base de donn&eacute;es.\n". mysqli_error($my_connect) ."\n");
		}
		mysqli_close($my_connect);
	} else {
?>

 				Bienvenue sur l'installation du miniShop Shirt*. Afin d'initialiser le minishop, veuillez renseigner les informations de connection au server de bases de donn&eacute;es. 
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