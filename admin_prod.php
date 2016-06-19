<?php
	
	session_start();
	include ("protec_admin.php");
	include ("my_connect.php");

	if (($_GET) != NULL)
	{
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			mysqli_query($my_connect, "UPDATE produit SET qt_stock = 0 WHERE ref_produit = $id");
		}
	}
	$ret = mysqli_query($my_connect, "SELECT * FROM produit WHERE qt_stock > 0");
	if ($ret != NULL)
	{
		$result = mysqli_fetch_all($ret, MYSQLI_ASSOC);
		if (is_array($result))
		{ include("header.php"); ?>
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
		<form action="update_article.php" method="post">
		<p>Update an article: </p>
			<a href="admin_prod.php?&id=<?php echo($value['ref_produit']); ?>">Delete</a> <br />
			<input type="hidden" name="ref_produit" value="<?php echo($value['ref_produit']); ?>" required /><br /> 
			<input type="text" name="product_name" value="<?php echo($value['product_name']); ?>" required /><br />
			<input type="number" min ="0" max="999999" name="qt_stock" value="<?php echo($value['qt_stock']); ?>" required /><br />
			<input type="number" min="0" max="999999999" name="price" value="<?php echo($value['price']); ?>"required /><br />
			<textarea rows="3" cols="64" name="description" required><?php echo($value['description']); ?></textarea>
			<br />
			<input type="text" name="link_img" value="<?php echo($value['link_img']); ?>" required /><br />
			<input type="text" name="categorie" value="<?php echo($value['categorie']); ?>" required /><br />
			<img style="width:100px;" src="<?php echo($value['link_img']); ?>" />
			<input type="submit" name="submit" value="Envoyer" required />
		</form><hr>
<?php  		}
		}
	}

?>

	<form action="add_article.php" method="post">
		<p>Ajouter un nouvel article: </p>
			<input type="text" name="product_name" placeholder="Nom de l'article" required /><br />
			<input type="number" max="999999" name="qt_stock" placeholder="Quantité" required /><br />
			<input type="number" max="999999999" name="price" placeholder="Prix" required /><br />
			<textarea rows="3" cols="64" name="description" placeholder="Description de l'article..." required></textarea>
			<br />
			<input type="text" name="link_img" placeholder="Url de l'image" required /><br />
			<input type="text" name="categorie" placeholder="Catégorie" required /><br />
			<input type="submit" name="submit" value="Envoyer" required />
	</form></div>
		</div>
<?php include("footer.php"); ?>