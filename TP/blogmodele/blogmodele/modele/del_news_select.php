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
	require_once("Modele/blog.php");
	// Recupère un éventuel no de départ
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	$from=1;
	if (isset($_GET["from"])) {
		$from = $_GET["from"];
	}
	// Ouvre le blog
	$blog = new Blog();
	// Affichage de 5 elements de blogs
	$id = $from;
	$news = $blog->getNews($id);
	while (($news != NULL) && ($id < $from+5)) {
		// Affiche en plus le bouton de destruction
		$delBtn = '<a href="del_news.php?from='.$from.'&del='.$id.'"><img src="icons/Button-Close-icon_24.png"/></a>';
		print $news->toHTML($delBtn);
		$id++;
		$news = $blog->getNews($id);
	}
	// Calcule la taille
	$max = $blog->max();
?>
<hr/>
<a href="add_news_form.php"><img src="icons/Button-Add-icon.png"/></a>
<a href="del_news_select.php"><img src="icons/Button-First-icon.png"/></a>
<?php $fromRewind = $from-5;
	if($fromRewind <=0) {$fromRewind=1;}
	print "<a href=\"del_news_select.php?from=$fromRewind\">"; ?><img src="icons/Button-Rewind-icon.png"/></a>
<?php
	$fromForward = $id;
	if ($fromForward> $max) {$fromForward=$max;}
	print "<a href=\"del_news_select.php?from=$fromForward\">"; ?><img src="icons/Button-Forward-icon.png"/></a>
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