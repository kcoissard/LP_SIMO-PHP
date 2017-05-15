<?php
	
	class News {
		public $titre = "PAS DE TITRE";
		// Un tableau de lignes
		public $contenu;
		protected $id; // Identifiant non modifiable
		public function __construct(
							 $id, // L'identifiant, sa position dans le blog
							 $t, // Une chaine pour le titre
							 $c  // une tableau de chaine pour le contenu
							 ){
			$this->id=$id;
			$this->titre =$t;
			$this->contenu=$c;
		}
		
		// Transforme en une chaine au format XHTML
		// Ajoute la chaine $extra entre le No et le titre
		public function toHTML($extra='') {
			$s= "<div class=\"news\">\n";
			$s.= "<h2>";
			// Insere l'éventuel extra
			$s.= $extra; 
			// Affichage de l'id
			$s.= "<span class=\"newsId\">".$this->id."</span>";
			// Affichage du titre
			$s.= $this->titre;
			$s.= "</h2>\n";
			
			// Affichage du contenu
			foreach ($this->contenu as $line) {
				$s.= $line."<br/>\n";
			}
			// Fin de la news
			$s.= "</div>\n";
			return $s;
		}
	}
?>