<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simple blog demo</title>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="../blog.css" />
</head>
<body>
<?php
	require_once("blog.php");
	$blog = new Blog();
	print "<p> Taille du blog = ".$blog->max()."</p>\n";
	$news = $blog->getNews(1);
	print $news->toHTML();
	print $news->toHTML('<a href="XXX"><img src="../icons/Button-Close-icon_24.png"/></a>');
	$news = $blog->getNextNews(2);
	print $news->toHTML();
	$news = $blog->getNextNews(3);
	print $news->toHTML();
?>
</body>
</html>

