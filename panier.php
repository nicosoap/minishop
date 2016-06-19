<?php
include("ft_panier.php");
if (($_POST[submit] === "Ajouter") && ($_POST[ref_produit] && ($_POST[qtt]))) {
	$product[qt] = $_POST[qtt];
	$product[ref_produit] = $_POST[ref_produit];
	if (!($user_id = who_connected())) {
		if (!panier_exists()) {
			create_panier($product);
			$cart = get_panier();
			show_panier($cart);
		} else /* panier_exists */ {
			$cart = modify_panier($product);
			show_panier($cart);
		}
	} else /* who_connected */ {
		if (!panier_exists_logged($user_id)) {
			echo "panier existe pas mais logged";
			$cart = create_panier_logged($user_id, $product);
			show_panier($cart);
		} else {
			$id = get_product_in_panier_logged($user_id. $product);
			$cart = modify_panier_logged($id, $product);
			show_panier($cart);

		}
	}
} elseif (($_POST[submit] === "Modifier") && ($_POST[ref_produit] && ($_POST[qtt]))) {
	echo "ERREUR";
} else {
	if (($user_id = who_connected()) == "") {
		if (!panier_exists()) {
			empty_panier();
		}else /* panier exists */ {
			$cart = get_panier();

			?>
		<div class="top-nav">
		<a href="index.php"><h1>Shirts*</h1></a>
		<?php include("log_me.php"); ?>
		</div><!-- /top nav -->
		<div class="main panier">
		<?php
			show_panier($cart);
		}
	} else /* who_connected */ {
		if (!panier_exists_logged($user_id)) {
			empty_panier();
		} else {
			$cart = get_panier_logged($user_id);
			show_panier($cart);
		}
	} /* who_connected */
} /* en if Ajouter */
?>
	</div><!-- /main -->
			
<?php
	include("footer.php");

?>