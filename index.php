<?php
	if (!file_exists("my_connect.php"))
		header("Location: install.php");
	session_start();
	include("header.php");
?>
		<div class="top-nav">
		<h1>Titre de la page</h1>
		<?php include("log_me.php"); ?>
		</div><!-- /top nav -->
		<div class="side-bar">
		<ul>
			<li>Categorie 1</li>
			<li>Categorie 1</li>
			<li>Categorie 1</li>
			<li>Categorie 1</li>
			<li>Categorie 1</li>
			<li>Categorie 1</li>
		</ul>
		</div><!-- /side-bar -->
		<div class="main">
		<?php foreach ($products as $value) { ?>
			<div class="product product-medium" id="<?php echo $value[ref_produit]; ?>">
			<a href="product.php?product=<?php echo $value[ref_produit]; ?> "><img src="<?php echo $value[link_image]; ?>" alt="none" /></a>
			<p><?php echo $value[description]; ?></p><p><?php echo $value[price]; ?><form action="panier.php" method="post"><input type="number" name="qtt" min="1" max="<?php echo $value[qt]; ?>" /><input type="submit" value="OK" label="Acheter" /></form></p>
			</div><!-- /product product-medium -->
		<?php } ?>
		</div><!-- /main -->
			
<?php
	include("footer.php");
?>