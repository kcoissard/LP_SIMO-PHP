<?php
	// Recupère un éventuel no de départ
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	// Parcours le fichier modifie le type de la première colonne
	$file = fopen("blog.txt","r+");
	// Note la position de cette ligne
	$currentLine = ftell($file);
	$line = fgets($file);
	// Note la position de la ligne suivante
	$nextLine = ftell($file);
	while (!feof($file)) {
		// Recupere le type de la ligne
		$type = $line[0];
		// Si la ligne était détruite
		if ($type=='#') {
			// revient au début de la ligne
			fseek($file,$currentLine);
			// replace le type annulé et l'espace
			fwrite($file,$line[1].' ');
			// reposition sur la ligne suivante
			fseek($file,$nextLine);
		}
		// Note la position de cette ligne
		$currentLine = ftell($file);
		$line = fgets($file);
		// Note la position de la ligne suivante
		$nextLine = ftell($file);
	}
	// Retourne dans le mode affichage avec conservation du No de départ
	header('Location: blog.php?from='.$from);
	?>