<?php 

	require_once('data.php');

	class Home {

		//ACTION PAR DEFAUT
		public function index()
		{
			global $data;
			$data = new Data;

			$data->menu['Home']="index.php";
			$data->menu['A propos']="index.php?controller=home&action=aPropos";
			$data->menu['Voir photos']="index.php?controller=photo&action=first";

			$data->content = "homeView.php";

			require_once('view/mainView.php');
		}

		public function aPropos()
		{
			global $data;
			$data = new Data;

			$data->menu['Home']="index.php";
			$data->menu['A propos']="index.php?controller=home&action=aPropos";
			$data->menu['Voir photos']="index.php?controller=photo&action=first";

			$data->content = "aproposView.php";

			require_once('view/mainView.php');

		}
		
	}
?>
