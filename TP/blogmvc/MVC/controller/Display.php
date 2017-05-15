<?php
	require_once("model/blog.php");
	
	class Display {
		
		protected $blog;
		
		function __construct() {
			// Ouvre le blog
			$this->blog = new Blog();
		}
		
		// Recupere les parametres de manière globale
		// Pour toutes les actions de ce contrôleur
		protected function getParam() {
			// Recupère un éventuel no de départ
			global $from,$mode;
			if (isset($_GET["from"])) {
				$from = $_GET["from"];
			} else {
				$from = 1;
			}
			// Recupere le mode delete de l'interface
			if (isset($_GET["mode"])) {
				$mode = $_GET["mode"];
			} else {
				$mode = "normal";
			}
		}
		
		// Place au moins 5 éléments à afficher
		// à partir de $from
		// dans $data de manière globale
		protected function setNews() {
			global $from,$mode,$data;
			// Selection de 5 elements de blogs pour affichage
			$id = $from;
			$news = $this->blog->getNews($id);
			$i = 1;
			while (($news != NULL) && ($i <= 5)) {
				if ($mode == "delete") {
					// Ajoute un bouton
					$delBtn = '<a href="index.php?controller=Display&action=delNews&from='.$from.'&mode='.$mode.'&delId='.$id.'"><img src="view/icons/Button-Close-icon_24.png"/></a>';
					$data[$i]= $news->toHTML($delBtn);
				} else {
					$data[$i]= $news->toHTML();
				}
				$id++;$i++;
				$news = $this->blog->getNews($id);
			}
		}
		
		// LISTE DES ACTIONS DE CE CONTROLEUR
		
		// Action par défaut
		function index() {
			global $from,$mode,$data;
			$this->getParam();
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		function backward() {
			global $from,$mode,$data;
			$this->getParam();
			$from = $from - 5;
			if($from <=0) {$from=1;}
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		function forward() {
			global $from,$mode,$data;
			$this->getParam();
			$from = $from + 5;
			$max = $this->blog->max();
			if($from > $max) {$from=$max;}
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		
		function first() {
			global $from,$mode,$data;
			$this->getParam();
			$from = 1;
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		function last() {
			global $from,$mode,$data;
			$this->getParam();
			$from = $this->blog->max()-4;
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		function add() {
			// Selectionne et charge la vue
			require_once("view/add_news_form.php");
		}
		
		function addNews() {
			global $from,$mode,$data;
			$titre=$_GET["titre"];
			$contenu=$_GET["content"];
			// Cree un nouvel objet News
			$news = new News(0,$titre,$contenu);
			// l'ajoute au blog
			$this->blog->addNews($news);
			// Recherche le nombre d'éléments
			$max = $this->blog->max();
			// Positionne sur le dernière page de 5 éléments
			$from = $max - 4;
			if ($from <= 0) {$from=1;};
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		function cancel() {
			global $from,$mode,$data;
			$this->getParam();
			$this->blog->cancel();
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}
		
		// Change de mode : normal ou delete
		function toggleMode() {
			global $from,$mode,$data;
			$this->getParam();
			if ($mode == "delete") {
				$mode = "normal";
			} else {
				$mode = "delete";
			}
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");
		}	
		
		function delNews() {
			global $from,$mode,$data;
			$this->getParam();
			// Recupère le No de News a detruire
			$delId = $_GET["delId"];
			$this->blog->delNews($delId);
			$from = $from -1;
			if ($from <= 0) {$from = 1;}
			$this->setNews();
			// Selectionne et charge la vue
			require_once("view/main.php");			
		}

	}
?>