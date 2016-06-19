<?php
	
	session_start();
	include ("protec_admin.php");	
	include("my_connect.php");

	$ret = mysqli_query($my_connect, "SELECT * FROM users");
	if ($ret != NULL)
	{
		$result = mysqli_fetch_all($ret, MYSQLI_ASSOC);
		if (is_array($result))
		{ 
			
	include("header.php"); ?>
	<div class="top-nav">
		<a href="index.php"><h1>Shirts*</h1></a>
		<?php include("log_me.php"); ?>
		</div><!-- /top nav -->
		<div class="side-bar">
		<ul>
				<li><a href="delete.php?id=<?php echo($_SESSION['auth']['user_id']);?>">Supprimer mon compte</a></li>
				<li><a class="" href="delog.php">Se déconnecter<img height="15px" src="http://img11.hostingpics.net/pics/251812error.png" /></a></li>
				<li><a class="" href="#">Mon Panier</a></li><?php if ($_SESSION[auth][is_admin]==1) {?>
				<li><a class="" href="admin_prod.php">Administration des produits</a></li>
				<li><a class="" href="admin_categ.php">Administration des cat&eacute;gories</a></li>
				<li><a class="" href="admin_users.php">Administration des utilisateurs</a></li><?php } ?>
			</ul>
		<?php include("search.php"); ?>
		</div><!-- /side-bar -->
	<div class="main admin"><?php
			foreach ($result as $key => $value)
			{
			?>
					
					<form action="update_users.php" method="post">
					<p>Update user :</p>
					<a href="delete.php?id=<?php echo($value['user_id']); ?>">Delete</a> <br />
					<input type="hidden" name="user_id" value="<?php echo($value['user_id']); ?>" required /><br />
					<input type="text" name="login" value="<?php echo($value['login']); ?>" required /><br />
					<input type="number" name="is_admin" min="0" max="1" value="<?php echo($value['is_admin']); ?>" required /><br />
					<input type="text" name="name" value="<?php echo($value['name']); ?>" required /><br />
					<input type="text" name="addr" value="<?php echo($value['addr']); ?>" required />
					<input type="number" name="postal_code" value="<?php echo($value['postal_code']); ?>" min="0" max="99999" required /><br />
					<input type="text" name="country" value="<?php echo($value['country']); ?>" required /><br />
					<input type="text" name="city" value="<?php echo($value['city']); ?>" required /><br />
					<input type="tel" name="phone" value="<?php echo($value['phone']); ?>" required /><br />
					<input type="email" name="mail" value="<?php echo($value['mail']); ?>" required /><br />
			<br />	<input type="submit" name="submit" value="Envoyer" required />
			</form><hr>
<?php  }
	}
}

?>
	<!-- Add User -->
		<form action="create.php" method="post">
		<p>Ajouter nouvel utilisateur :</p>
					<input type="text" name="login" placeholder="Identifiant" required /><br />
					<input type="password" name="passwd" placeholder="Password" required /><br />
					<input type="text" name="name" placeholder="Nom" required /><br />
					<input type="text" name="addr" placeholder="Adresse" required />
					<input type="number" name="postal_code" placeholder="Postal" min="0" max="99999" required /><br />
					<input type="text" name="country" placeholder="Pays" required /><br />
					<input type="text" name="city" placeholder="Ville" required /><br />
					<input type="tel" name="phone" placeholder="Telephone" required /><br />
					<input type="email" name="mail" placeholder="E-mail" required /><br />
			<br />	<input type="submit" name="submit" value="Envoyer" required />
		</form></div>
		</div>
<?php include("footer.php"); ?>