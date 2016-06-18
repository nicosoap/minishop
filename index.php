<?php
	include("header.php");
?>

		<div class="central>
			<p>
				<form action="login.php" method="get">
					<input type="text" name="login" placeholder="Login" />
					<input type="password" name="passwd" placeholder="Mot de passe" />
					<input type="submit" name="submit" value="OK" />
				</form>
			</p>
			<p>
				<a href="create.html">Cr&eacute;er un compte</a>
				<a href="modif.html">Modifier le mot de passe</a>
			</p>
		</div>
<?php
	include("footer.php");
?>