<!DOCTYPE>
<html>
	<head>
		<title>TP 3 IMAGE MVC</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="./visuel/css/style.css" />

		<!--BOOTSTRAP 3.3.7 pour aller plus vite-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


		<title>Mon gestionnaire d'images</title>
	</head>

	<body>
		<!--MENU PRINCIPAL (navbar) -->
		<?php 
			include 'includes/navbar.php';
		?>

		<?php
			//on récupère l'action
			$action='';

			if(isset($_GET['action']))
			{
				$action=htmlspecialchars($_GET['action']);

				if(is_file('vues/'.$action.'Vue.php'))
				{

					switch ($action)
					{
					 	case 'accueil':
					        include('vues/'.$action.'Vue.php');
					        break;
					    case 'aPropos':
					        include('vues/'.$action.'Vue.php');
					        break;
					}
				}
			}
			else
			{
				include'accueilVue.php';
			}
		?>

	</body>
</html>