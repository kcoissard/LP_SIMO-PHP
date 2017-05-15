<?php
	require_once("Modele/blog.php");
	// recupère le titre et le contenu
	$titre=$_GET["titre"];
	$contenu=$_GET["content"];
	// Cree un objet
	$news = new News(0,$titre,$contenu);
	// Ajoute la nouvelle au blog
	$blog = new Blog;
	$blog->addNews($news);
	// Recherche le nombre d'éléments
	$max = $blog->max();
	// Positionne sur le dernière page de 5 éléments
	$from = $max -4;
	if ($from <= 0) {$from=1;};
	// Demande de redirection pour afficher ce nouvel élément
	header('Location: blog.php?from='.$from);
?>