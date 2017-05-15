<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simple blog demo</title>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="blog.css" />
</head>
<body>
<div id="content">
<h1> Mon Blog </h1>
<?php
	// Recupère un éventuel no de départ
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	// Affichage de 5 elements de blogs
	$file = fopen("blog.txt","c+");
	$num = 0; // No du blog courant
	$line = fgets($file);
	// Recupere le type de la ligne
	$type = $line[0];
	// Regarde si on a trouve la première nouvelle
	if ($type == 'T') {$num++;}	
	while (!feof($file) && $num-$from < 5) {
		// Supprime le type (2 caractères)
		$line = substr($line,2);
		// Supprime les caractères blancs à la fin de la ligne
		$line=rtrim($line);
		// Indicateur de tag div ouvert
		$tagDivOpen=false;
		// Regarde si c'est un titre
	    switch ($type) {
			case 'T' :
				if ($num >= $from) {
					if($tagDivOpen) {print "</div>\n";}
					print "<div class=\"news\">\n";$tagDivOpen=true;
					print "<h2>";
					// Affiche en plus le bouton de destruction
					print '<a href="del_news.php?from='.$from.'&del='.$num.'"><img src="icons/Button-Close-icon_24.png"/></a>';
					print "<span class=\"newsId\">".$num."</span>";
					print $line."</h2>\n";
				}
				break;
			case 'C' : // Contenu
				if ($num >= $from) {
					print $line."<br/>\n";
				}
				break;
		}
		// Passe à la ligne suivante
		$line = fgets($file);
		// Recupere le type de la ligne
		$type = $line[0];
		// Regarde si on passe à la nouvelle suivante
		if ($type == 'T') {$num++;}
	}
	if($tagDivOpen) {print "</div>\n";}
	fclose($file);
	// Recherche le nombre d'éléments
	$file = fopen("blog.txt","r");
	$line = fgets($file);
	$max = 0;
	while (!feof($file)) {
		if ($line[0] == 'T') {$max++;}
		$line = fgets($file);
	}
	fclose($file);
?>
<hr/>
<a href="add_news_form.php"><img src="icons/Button-Add-icon.png"/></a>
<a href="del_news_select.php"><img src="icons/Button-First-icon.png"/></a>
<?php $fromRewind = $from-5;
	if($fromRewind <=0) {$fromRewind=1;}
	print "<a href=\"del_news_select.php?from=$fromRewind\">"; ?><img src="icons/Button-Rewind-icon.png"/></a>
<?php print "<a href=\"del_news_select.php?from=$num\">"; ?><img src="icons/Button-Forward-icon.png"/></a>
<?php 

	$nb = $max -4;
	if ($nb <= 0) {$nb=1;};
	print "<a href=\"del_news_select.php?from=$nb\">"; ?>
<img src="icons/Button-Last-icon.png"/></a>
<?php print "<a href=\"blog.php?from=$from\">";?><img src="icons/Button-Close-icon.png"/></a>
<a href="cancel.php"><img src="icons/Button-Cancel-icon.png"/></a>
<hr/>
</div>
</body>
</html>