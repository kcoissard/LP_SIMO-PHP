<?php
	// Recupère un éventuel no de départ
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	require_once("Modele/blog.php");
	$blog = new Blog();
	$blog->cancel();
	// Retourne dans le mode affichage avec conservation du No de départ
	header('Location: blog.php?from='.$from);
?>