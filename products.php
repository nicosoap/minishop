<?php
	
	switch ($_SESSION[actual_page]) {
		case 'homepage':
			include("my_connect.php");
			$sql = "SELECT * FROM produit WHERE qt_stock > 0 LIMIT 12";
			if ($my_query = mysqli_query($my_connect, $sql)) {
				while ($value = mysqli_fetch_assoc($my_query)) { ?>
				<div class="product product-medium" id="<?php echo $value[ref_produit].'">'; ?>
					<a href="product.php?product=<?php echo $value[ref_produit]; ?>">
						<img src="<?php echo $value[link_img]; ?>" alt="<?php echo $value[product_name]; ?>">
					</a>
					<span><?php echo $value[product_name]; ?></span><p><?php echo $value[description]; ?></p><p><form action="panier.php" method="post"><span class="price"><?php echo intval($value[price]); ?> &euro;</span><input name="ref_produit" type="hidden" value="<?php echo $value[ref_produit]; ?>" /><span class="quantities"><input type="number" name="qtt" value="1" min="1" max="<?php echo $value[qt_stock]; ?>" /><input name="submit"type="submit" value="Ajouter" label="Acheter" /></form></span></p>
				</div> <!-- /product product-medium -->
			<?php }
			}
			break;
		case 'product':
			$sql = "SELECT * FROM produit WHERE ref_produit = ". $_GET[product]." LIMIT 1";
			if (($my_query = mysqli_query($my_connect, $sql))) {
				$my_query = mysqli_fetch_assoc($my_query);
				?><div class="product product-large">
					<img src="<?php echo $my_query[link_img]; ?>" alt="<?php echo $my_query[product_name]; ?>">
						<h2><?php echo $my_query[product_name]; ?></h2>
						<p><?php echo $my_query[description]; ?></p>
						<p><form action="panier.php" method="post">
						<span class="price"><?php echo intval($my_query[price]); ?> &euro;</span><input name="ref_produit" type="hidden" value="<?php echo $my_query[ref_produit]; ?>" />
						<span class="quantities"><input type="number" name="qtt" value="1" min="1" max="<?php echo $my_query[qt_stock]; ?>" /><input name="submit" type="submit" value="Ajouter" label="Acheter" /></form></span>
						</p>
						</form>
						</p>
					</div>
			<? }
			break;
		case 'dashboard':
			$sql = "SELECT * FROM produit";
			if (($my_query = mysqli_query($my_connect, $sql))) {
				$my_query = mysqli_fetch_array($my_query);

			}
			break;
		/*case 'panier':
			$sql = "SELECT produit.ref_produit, user_id, price, description, link_img, product_name, categorie, qt_stock, qt, status, key_panier FROM panier INNER JOIN produit ON produit.ref_produit = panier.ref_produit WHERE status = 1 AND user_id = ".$_SESSION[auth][user_id];
			if (!($my_query = mysqli_query($my_connect, $sql)))
				mysqli_error($my_connect);
			else { ?>
				<div class="panier">
				<h2>Panier</h2><a href="order.php"><span class="far_right">Commandez aujourd'hui pour &ecirc;tre livr&eacute; le <?php echo strftime("%d/%m/%Y", time() + (86400 * 2)); ?> au matin.</span></a>
				</div> <?php
				while ($value = mysqli_fetch_assoc($my_query)) { 
					$total_price += ($value[qt] * $value[price]); ?>
				<div class="product product-slim panier" id="<?php echo $value[ref_produit].'">'; ?>
					<a href="product.php?product=<?php echo $value[ref_produit]; ?>">
						<img src="<?php echo $value[link_img]; ?>" alt="<?php echo $value[product_name]; ?>">
					</a>
					<span><?php echo $value[product_name]; ?></span><p><?php echo $value[description]; ?></p><p><form action="panier.php" method="post"><span class="price"><?php echo intval($value[price]); ?> &euro;</span><span class="quantities"><input type="number" name="qtt" value="<?php echo $value[qt]; ?>" min="1" max="<?php echo $value[qt_stock]; ?>" /><input type="submit" value="Mettre &agrave; jour" label="Mettre &agrave; jour" /></form></span></p>
				</div> <!-- /product product-medium -->
			<?php } ?>
			<div class="panier">
				<h2>Total</h2><a href="order.php"><span class="far_right"><?php echo $total_value." &euro; (dont ".intval(($total_value / 1.2) - $total_value)." &euro; de TVA)"; ?></span></a> <a href="order.php"><span class="far_right">Commandez aujourd'hui pour &ecirc;tre livr&eacute; le <?php echo strftime("%d/%m/%Y", time() + (86400 * 2)); ?> au matin.</span></a>
				</div>
				<?php
			}
			break;*/
		case 'categorie':
			include("my_connect.php");
			$cat = $_SESSION[cat];
			$cat = preg_replace("/,/", "#", $cat);
			include("epur_str.php");
			$cat = ft_epur($cat);
			$cat = str_replace(" ", "#", $cat);
			$scat = explode('#', $cat);
			$sql = "SELECT * FROM produit WHERE qt_stock > 0 AND";
			foreach ($scat as $cat) {
				$sql .= " UPPER(categorie) LIKE UPPER('%".$cat."%') AND";
			} 
			$sql .= " 1";
			if (($my_query = mysqli_query($my_connect, $sql))) {
				while ($value = mysqli_fetch_assoc($my_query)) { ?>
				<div class="product product-medium" id="<?php echo $value[ref_produit].'">'; ?>
					<a href="product.php?product=<?php echo $value[ref_produit]; ?>">
						<img src="<?php echo $value[link_img]; ?>" alt="<?php echo $value[product_name]; ?>">
					</a>
					<span><?php echo $value[product_name]; ?></span><p><?php echo $value[description]; ?></p><p><form action="panier.php" method="post"><span class="price"><?php echo intval($value[price]); ?> &euro;</span><span class="quantities"><input type="number" name="qtt" value="1" min="1" max="<?php echo $value[qt_stock]; ?>" /><input type="submit" value="Ajouter" label="Acheter" /></form></span></p>
				</div> <!-- /product product-medium -->
			<?php }
			}
			break;
		default:
			$sql = "SELECT * FROM produit WHERE qt_stock > 0";
			if (($my_query = mysqli_query($my_connect, $sql))) {
				$my_query = mysqli_fetch_array($my_query);
			}
			break;
	}
?>