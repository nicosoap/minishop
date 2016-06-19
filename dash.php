<?php
session_start();
if ($_SESSION == NULL || !isset($_SESSION['auth']) || $_SESSION['auth']['is_admin'] == NULL || $_SESSION['auth']['is_logged'] !== TRUE)
{
	header('Location: index.php');
	exit();
}
include("my_connect.php");
include("header.php");
?>
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
		</div>
		<div class="main">
		<div class="section_dashboard" id="panier"><img src="http://img15.hostingpics.net/pics/112691cart.png"></div><!-- section dashboard -->
		<div class="section_dashboard" id="info-perso">
		<p>Nom : <?php echo ($_SESSION['auth']['name'])?> </p>
		<p>Adresse : <?php echo ($_SESSION['auth']['addr'])?> </p>
		<p>Code Postale : <?php echo ($_SESSION['auth']['postal_code'])?> </p>
		<p>Pays : <?php echo ($_SESSION['auth']['country'])?> </p>
		<p>Ville : <?php echo ($_SESSION['auth']['city'])?> </p>
		<p>Tel : <?php echo ($_SESSION['auth']['phone'])?> </p>
		<p>E-mail : <?php echo ($_SESSION['auth']['mail'])?> </p>
		</div>
		</div>
<?php
include("footer.php");
?>