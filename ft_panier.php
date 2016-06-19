<?php

function who_connected() {
	if (isset($_SESSION[auth][user_id]))
		return $_SESSION[auth][user_id];
	else
		return "";
}

function panier_exists_logged($user_id) {
	include("my_connect.php");
	$sql = "SELECT key_panier FROM panier WHERE status = 1 AND user_id = ".user_id." DESC key_panier LIMIT 1";
	if (!($query_1 = mysqli_query($my_connect, $sql)))
		mysqli_error($my_connect);
	else {
		$keys = mysqli_fetch_assoc($query_1);
		$key_panier = $keys[key_panier];
		if (!($key_panier))
			return FALSE;
		else
			return TRUE;
		 }
}

function create_panier_logged($user_id, $product) {
	include("my_connect.php");
	$sql_insert = 'INSERT INTO panier(qt, user_id, ref_produit, status) VALUES ('.$product[qt].', '.$user_id.', '.$product[ref_produit].', 1)';
	if (!(mysqli_query($my_connect, $sql_insert))) {
		return FALSE;
	} else {
		return TRUE;
	}
}

function get_panier_logged($user_id) {
	include("my_connect.php");
	$sql = "SELECT produit.ref_produit, user_id, price, description, link_img, product_name, categorie, qt_stock, qt, status, key_panier FROM panier INNER JOIN produit ON produit.ref_produit = panier.ref_produit WHERE status = 1 AND user_id = ".$user_id;
	if (!($query_1 = mysqli_query($my_connect, $sql)))
		mysqli_error($my_connect);
	else {
		$cart = mysqli_fetch_array($query_1);
		$cart[key_panier] = $cart[0][key_panier];
		return $cart;
	}
}

function get_product_in_panier_logged($user_id, $product) {
	include("my_connect.php");
	$sql = "SELECT id FROM panier WHERE status = 1 AND user_id = ".$user_id." AND ref_produit = ".$product[ref_produit];
	if (!($query_1 = mysqli_query($my_connect, $sql)))
		mysqli_error($my_connect);
	else {
		$keys = mysqli_fetch_assoc($query_1);
		return $keys[id];
	}
}

function modify_panier_logged($id, $product) {
	include("my_connect.php");
	$sql_test = 'SELECT * FROM panier INNER JOIN produit ON produit.ref_produit = panier.ref_produit WHERE id = '.$product[id];
	if (!($test_panier = mysqli_query( $my_connect, $sql_test)))
		mysqli_error($my_connect);
	$test_panier = mysqli_fetch_assoc($test_panier);
	$key_panier = $test_panier[key_panier];
	if (($product[qt] + $test_panier[qt]) <= $test_panier[qt_stock])
		$product[qt] += $test_panier[qt];
	$sql_update = 'UPDATE panier SET qt='.$product[qt].' WHERE id = '.$product[id];
	if (!($test_panier = mysqli_query( $my_connect, $sql_update)))
		mysqli_error($my_connect);
	$cart = mysqli_fetch_array($test_panier);
	//$cart[key_panier] = $key_panier;
	return $cart;
}

function show_panier($cart) {
	include("header.php"); ?>
	<div class="panier">
	<h2>Panier</h2><a href="order.php"><span class="far_right">Commandez aujourd'hui pour &ecirc;tre livr&eacute; le <?php echo strftime("%d/%m/%Y", time() + (86400 * 2)); ?> au matin.</span></a>
	</div> 
	<?php foreach($cart as $value) { 
		$total_price += ($value[qt] * $value[price]); ?>
	<div class="product product-slim panier" id="<?php echo $value[ref_produit].'">'; ?>
		<a href="product.php?product=<?php echo $value[ref_produit]; ?>">
			<img src="<?php echo $value[link_img]; ?>" alt="<?php echo $value[product_name]; ?>">
		</a>
		<span><?php echo $value[product_name]; ?></span><p><?php echo $value[description]; ?></p><p><form action="panier.php" method="post"><span class="price"><?php echo intval($value[price]); ?> &euro;</span><span class="quantities"><input type="number" name="qtt" value="<?php echo $value[qt]; ?>" min="1" max="<?php echo $value[qt_stock]; ?>" /><input type="submit" value="Mettre &agrave; jour" label="Mettre &agrave; jour" /></form></span></p>
	</div> <!-- /product product-medium -->
<?php } ?>
<div class="panier">
	<h2>Total</h2><a href="order.php"><span class="far_right"><?php echo intval($total_value)." &euro; (dont ".intval(($total_value / 1.2) - $total_value)." &euro; de TVA)"; ?></span></a> <a href="order.php"><span class="far_right">Commandez aujourd'hui pour &ecirc;tre livr&eacute; le <?php echo strftime("%d/%m/%Y", time() + (86400 * 2)); ?> au matin.</span></a>
	</div>
	<?php
	$cart[total_value] = $total_value;
	return $cart;
}

/*function purchase_panier_logged($cart) {
	$key_panier = $cart[key_panier];
	foreach ($cart as $key => $value) {
		$sql_update = 'UPDATE produit SET qt_stock='.$product[qt].' WHERE ref_produit = '.$value[ref_produit];
	}
	
	return TRUE;
}*/

function archive_panier_logged($key_panier) {
	include("my_connect.php");
	$sql_update = 'UPDATE panier SET status=0 WHERE key_panier = '.$key_panier;
	if (!(mysqli_query($my_connect, $sql_update)))
		mysqli_error($my_connect);
	return TRUE;
}

function get_user_archived_panier($user_id) {
	include("my_connect.php");
	$sql = "SELECT produit.ref_produit, user_id, price, description, link_img, product_name, categorie, qt_stock, qt, status, key_panier FROM panier INNER JOIN produit ON produit.ref_produit = panier.ref_produit WHERE status = 0 AND user_id = ".$user_id." DESC key_panier";
	if (!($query_1 = mysqli_query($my_connect, $sql)))
		mysqli_error($my_connect);
	else {
		$cart = mysqli_fetch_array($query_1);
		return $cart;
	}
}

function show_archived_panier($cart) {?>
	
		include("header.php");
		<div class="panier">
	<h2>Paniers archiv&eacute;s</h2><span class="far_right">Commande pr&eacute;c&eacute;demment pass&eacute;es sur notre site :</span>
	</div> 
	<?php foreach ($cart as $key => $value) { 
			if ($key_panier !== $value[key_panier]) {
				$key_panier = $value[key_panier]; ?>
				<div class="panier">
		<h2>Panier archiv&eacute;</h2><span class="far_right">Commande du : <?php echo strftime("%d/%m/%Y", $key_panier); ?></span>
		</div> <?php
			}
		$total_price += ($value[qt] * $value[price]); ?>
	<div class="product product-slim panier" id="<?php echo $value[ref_produit].'">'; ?>
		<a href="product.php?product=<?php echo $value[ref_produit]; ?>">
			<img src="<?php echo $value[link_img]; ?>" alt="<?php echo $value[product_name]; ?>">
		</a>
		<span><?php echo $value[product_name]; ?></span><p><?php echo $value[description]; ?></p><p><form action="panier.php" method="post"><span class="price"><?php echo intval($value[price]); ?> &euro;</span><span class="quantities"><input type="number" name="qtt" value="<?php echo $value[qt]; ?>" min="1" max="<?php echo $value[qt_stock]; ?>" /><input type="submit" value="Mettre &agrave; jour" label="Mettre &agrave; jour" /></form></span></p>
	</div> <!-- /product product-medium -->
	<?php } ?>
	<div class="panier">
	<h2>Total</h2><span class="far_right"><?php echo intval($total_value)." &euro; (dont ".intval(($total_value / 1.2) - $total_value)." &euro; de TVA)"; ?></span></a> <a href="order.php"><span class="far_right">Commandez aujourd'hui pour &ecirc;tre livr&eacute; le <?php echo strftime("%d/%m/%Y", time() + (86400 * 2)); ?> au matin.</span></a>
	</div>
	<?php
	$cart[total_value] = $total_value;
	return $cart;
}

function panier_exists() {
	if ($_COOKIE[cart])
		return TRUE;
	else
		return FALSE;
}

function create_panier($product) {
	include("my_connect.php");
	$sql = "SELECT * FROM produit WHERE ref_produit = ".$product[ref_produit];
	if (!($return = mysqli_query($my_connect, $sql)))
		mysqli_error($my_connect);
	else {
	$cart = mysqli_fetch_array($return);
		setcookie('cart', serialize($cart), time()+60*60*24*30);
		return $cart;
	}
}

function get_panier() {
	$cart = unserialize($_COOKIE[cart]);
	return $cart;
}

function modify_panier($product) {
	if (panier_exists)
		$cart = get_panier();
	else
		die("ERROR");
	foreach ($cart as $key => $value) {
		if ($value[ref_produit] == $product[ref_produit]) {
			$cart[$key][qt] += $product[qt];
		}
	}
	return $cart;
}

function empty_panier() {
	echo "Panier vide.";
}
/*function purchase_panier($cart){

	return TRUE;




*/ ?>