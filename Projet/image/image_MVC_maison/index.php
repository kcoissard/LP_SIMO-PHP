<?php
session_start();


//Connexion à la base de données (transformée en version mySQL)
$bdd=new PDO('mysql:host=localhost;dbname=php_tp1','root','');

$page='';

if(isset($_GET['page']))
{
	$page=htmlspecialchars($_GET['page']);

	if(is_file('controleurs/'.$page.'Controlleur.php'))
	{

		switch ($page)
		{
		 	case 'accueil':
		        include('controleurs/'.$page.'Controlleur.php');
		        break;
		    case 'photo':
		        include('controleurs/'.$page.'Controlleur.php');
		        break;
		    case 'photoMatrice':
		        include('controleurs/'.$page.'Controlleur.php');
		        break;
		}
	}
	else
	{
		//vue à créer si temps dispo
		echo 'error 404 - Page non trouvée';
	}
	
}
else
	{
		//Par défaut page d'accueil
		include('controleurs/accueilControlleur.php');
	}





?>