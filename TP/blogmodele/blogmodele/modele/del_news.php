<?php
	require_once("Modele/blog.php");
	// Recupère un éventuel no de départ
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	// Recupère le No de News a detruire
	if (isset($_GET["del"])) {
		$del = $_GET["del"];
	} else {
		header('Location: blog.php?from='.$from);
	}
	// Ouvre le blog
	$blog = new Blog();
	// Supprime la news
	$blog->delNews($del);
	// Parcours le fichier modifie le type de la première colonne
	header('Location: del_news_select.php?from='.$from);
	?>