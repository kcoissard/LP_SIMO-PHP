<?php
	$file = fopen("blog.txt","a");
	// recupère le titre
	$titre=$_GET["titre"];
	// L'ajoute au fichier avec le format
	fwrite($file,"T ".$titre."\n");
	// Recupère le contenu et place chaque ligne dans un tableau
	$content=preg_split("/[\n\r]+/",$_GET["content"]);
	// Le sort dans le fichier
	foreach($content as $line) {
		fwrite($file,"C ".$line."\n");
	}
	fclose($file);
	// Recherche le nombre d'éléments
	$file = fopen("blog.txt","r");
	$line = fgets($file);
	$nb = 0;
	while (!feof($file)) {
		if ($line[0] == 'T') {$nb++;}
		$line = fgets($file);
	}
	$from = $nb -4;
	if ($from <= 0) {$from=1;};
	// Demande de redirection pour afficher ce nouvel élément
	header('Location: blog.php?from='.$from);
?>