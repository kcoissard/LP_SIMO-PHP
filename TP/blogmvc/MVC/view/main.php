<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simple blog demo</title>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="view/blog.css" />
</head>
<body>
<div id="content">
<h1> Mon Blog </h1>
<?php
	// Affiche les elements de blogs
	$i=1;
	while (isset($data[$i])) {
		print $data[$i];
		$i++;
	}
?>
<hr/>
<a href="index.php?controller=Display&action=add"><img src="view/icons/Button-Add-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=first&from=$from&mode=$mode\">"; ?><img src="view/icons/Button-First-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=backward&from=$from&mode=$mode\">"; ?><img src="view/icons/Button-Rewind-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=forward&from=$from&mode=$mode\">"; ?><img src="view/icons/Button-Forward-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=last&from=$from&mode=$mode\">"; ?><img src="view/icons/Button-Last-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=toggleMode&from=$from&mode=$mode\">";?><img src="view/icons/Button-Close-icon.png"/></a>
<?php print "<a href=\"index.php?controller=Display&action=cancel&from=$from\">";?><img src="view/icons/Button-Cancel-icon.png"/></a>
<hr/>
</div>
</body>
</html>