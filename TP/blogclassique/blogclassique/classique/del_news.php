<?php
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
	// Parcours le fichier modifie le type de la première colonne
	// en D
	$file = fopen("blog.txt","r+");
	$num = 0; // No du blog courant
	// Note la position de cette ligne
	$currentLine = ftell($file);
	$line = fgets($file);
	// Note la position de la ligne suivante
	$nextLine = ftell($file);
	while (!feof($file)) {
		// Recupere le type de la ligne
		$type = $line[0];
		// Regarde si c'est un titre
	    if ($type == 'T') { $num++;}		
		if ($num == $del && ($type == 'T' || $type == 'C')) { 
			// Ligne à marquer detruite
			fseek($file,$currentLine);
			// Change juste les deux premiers caractères de la ligne
			fwrite($file,"#".$type);
			// reposition sur la ligne suivante
			fseek($file,$nextLine);
		}
		// Note la position de cette ligne
		$currentLine = ftell($file);
		$line = fgets($file);
		// Note la position de la ligne suivante
		$nextLine = ftell($file);
	}
	header('Location: del_news_select.php?from='.$from);
	?>