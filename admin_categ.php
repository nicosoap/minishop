<?php
	
	session_start();
	include ("protec_admin.php");
	include("my_connect.php");

	if (($_GET) != NULL)
	{
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			if (isset($_GET['action']) && $_GET['action'] === "update")
					mysqli_query($my_connect, "UPDATE categorie SET name = '$_POST[name]' WHERE cat_id = $id");
			else if (isset($_GET['action']) && $_GET['action'] === "del")
				mysqli_query($my_connect, "UPDATE categorie SET active = 0 WHERE cat_id = $id");
		} 
	}
	$ret = mysqli_query($my_connect, "SELECT * FROM categorie WHERE active = 1");
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
			<form action="admin_categ.php?action=update&id=<?php echo($value['cat_id']); ?>" method="post">
					<p>Update categorie :</p>
					<a href="admin_categ.php?action=del&id=<?php echo($value['cat_id']); ?>">Delete</a> <br />
					<input type="text" name="name" value="<?php echo($value['name']); ?>" required /><br />
			<br />	<input type="submit" name="submit" value="Envoyer" required />
			</form><hr>
<?php  		}
		}
	}

?>
	<form action="add_categ.php" method="post">
		<p>Ajouter une nouvelle catégorie : </p>
		<input type="text" name="name" placeholder="Nom de la catégorie" required /><br />
		<br /><input type="submit" name="submit" value="Envoyer" required />
	</form></div>
		</div>
<?php include("footer.php"); ?>