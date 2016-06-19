<?php
	if (!file_exists("my_connect.php"))
		header("Location: install.php");
	/*elseif (file_exists("install.php")){
		include('header.php');
		die ("<div class='central'><h1>DANGER !</h1><br />Veuillez supprimer le fichier install.php avant d'ouvrir le minishop ! Ce fichier contient des acc&egrave;s &agrave; vos donn&eacute;es sensibles.<br /><a href='index.php?destroy_install_files=true'>Cliquez ici pour supprimer la menace</a></div></div></body></html>");
	}*/
	session_start();
	switch ($_GET[page]) {
		case 'categorie':
		if (isset($_GET[cat])) {
				$_SESSION[actual_page] = "categorie";
				echo $_SESSION[actual_page];
				$_SESSION[cat]=$_GET[cat];
			}
			break;
		case 'credit':
			header("Location: http://www.liveoption.io/");
			break;
		default:
			$_SESSION[actual_page]="homepage";
			break;
	}
	include("header.php");
?>
		<div class="top-nav">
		<a href="index.php"><h1>Shirts*</h1></a>
		<?php include("log_me.php"); ?>
		</div><!-- /top nav -->
		<div class="side-bar">
		<ul>
		<?php include("categorie.php"); ?>
		</ul>
		<?php include("search.php"); ?>
		</div><!-- /side-bar -->
		<div class="main">
		<?php include("products.php"); ?>
		</div><!-- /main -->
			
<?php
	include("footer.php");
?>