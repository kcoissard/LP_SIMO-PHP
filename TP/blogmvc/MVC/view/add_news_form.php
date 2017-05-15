<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simple blog demo</title>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="view/blog.css" />
</head>
<body>
<div id="content">
<h1> Ajouter une nouvelle au blog </h1>
<form action="index.php" method="get">
<label for="title">Titre : </label><input type="text" name="titre" size="80" /> <br/>
<label for="content">Contenu :</label><textarea rows="20" cols="58" name="content">Votre texte ici</textarea> <br/>
<input type="hidden" name="controller" value="Display"/>
<input type="hidden" name="action" value="addNews"/>
<input type="submit" value="Ajouter"/>
</form>
</div>
</body>
</html>