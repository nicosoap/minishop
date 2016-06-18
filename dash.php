<?php
include("my_connect.php");
include("auth.php");
include("header.php");
?>
		<div class="top-nav">
		<h1>minishop</h1>
		</div><!-- /top-nav -->
		<nav class="st-menu st-effect-4" id="side">
			<h2 class="icon icon-lab">Menu</h2>
			<ul>
				<li><a class="" href="#panier">Mon Panier</a></li>
				<li><a class="" href="#commandes-passees">Mes Commandes Pass&eacute;es</a></li>
				<li><a class="" href="#info-perso">Mes Informations Personnelles</a></li>
				<li><a class="" href="#">Administration ventes</a></li>
				<li><a class="" href="#">Administration des produits</a></li>
				<li><a class="" href="#">Administration des cat&eacute;gories</a></li>
				<li><a class="" href="#">Administration des utilisateurs</a></li>
			</ul>
		</nav>
		<div class="section_dashboard" id="panier"></div><!-- section dashboard -->
		<div class="section_dashboard" id="commandes-passees"></div><!-- section dashboard -->
		<div class="section_dashboard" id="info-perso"></div><!-- section dashboard -->
		<div class="section_dashboard" id="admin-ventes">
			<table id="admin-ventes">
			<form name="ventes" action="#" method="post">
				<tr></tr>
				<?php for ($i=0; $i < 10; $i++) { ?>
				<tr><td><input type="text" name="<?echo "nom de substitution";?>" /></td></tr>
				<?php } ?>
				<tr><input type="submit" value="OK" /></tr>
				</tr></form>
			</table>
		</div><!-- section dashboard -->
		<div class="section_dashboard" id="admin-produits">
			<table id="admin-produits">
			<form name="produits" action="#" method="post">
				<tr></tr>
				<?php for ($i=0; $i < 10; $i++) { ?>
				<tr><td><input type="text" name="<?echo "nom de substitution";?>" /></td></tr>
				<?php } ?>
				<tr><input type="submit" value="OK" /></tr>
				</tr></form>
			</table>
			</div><!-- section dashboard -->
		<div class="section_dashboard" id="admin-categories">
			<table id="admin-categories">
			<form name="categories" action="#" method="post">
				<tr></tr>
				<?php for ($i=0; $i < 10; $i++) { ?>
				<tr><td><input type="text" name="<?echo "nom de substitution";?>" /></td></tr>
				<?php } ?>
				<tr><input type="submit" value="OK" /></tr>
				</tr></form>
			</table>
			</div><!-- section dashboard -->
		<div class="section_dashboard" id="admin-users">
			<table id="admin-users">
			<form name="users" action="#" method="post">
				<tr></tr>
				<?php for ($i=0; $i < 10; $i++) { ?>
				<tr><td><input type="text" name="<?echo "nom de substitution";?>" /></td></tr>
				<?php } ?>
				<tr><input type="submit" value="OK" /></tr>
				</tr></form>
			</table>
		</div><!-- section dashboard -->
<?php
include("footer.php");
?>