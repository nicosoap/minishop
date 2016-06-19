<?php
	session_start();
	$_SESSION[last_page_visited]=$_SESSION[actual_page];
	$_SESSION[actual_page]="product";
	include("header.php");
?>
		<div class="top-nav">
		<a href="index.php"><h1>Shirts*</h1></a>
		<?php include("log_me.php"); ?>
		</div><!-- /top nav -->
		<div class="main">
		<?php include("products.php"); ?>
		</div><!-- /main -->
			
<?php
	include("footer.php");
?>