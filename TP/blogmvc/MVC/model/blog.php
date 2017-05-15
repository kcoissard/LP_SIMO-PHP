<?php
	require_once("news.php");
	
	class Blog {
		const filename = 'model/blog.txt';
		protected $file;
		protected $lastId; // Conserve l'id de la dernière news lue
		// pour optimiser une lecture séquencielle
		function __construct() {
			$this->file = fopen(self::filename,"r+");
			$this->lastId=0;
		}
		
		// Retourne le nombre de news du blog
		function max() {
			// repart au début du fichier
			fseek($this->file,0); 
			$line = fgets($this->file);
			$max = 0;
			while (!feof($this->file)) {
				if ($line[0] == 'T') {$max++;}
				$line = fgets($this->file);
			}	
			fseek($this->file,0); 
			$this->lastId=0;
			return $max;
		}
		
		// Recupère une news à un indice donné
		function getNews($id // le Nom de la nouvelle  >=1 et <= max()
						 )
		{
			// Solution ou les nouvelles sont dans un fichier
			// Optimisation pour une lecture en séquence
			if ($id <= $this->lastId) {
				// il faut repartir au début du fichier
				fseek($this->file,0);
				$this->lastId = 0;
			}
			// Ici $this->lastId < $id
			$line = fgets($this->file);
			// Recupere le type de la ligne
			$type = $line[0];
			// Regarde si on a trouve la première nouvelle
			if ($type == 'T') {$this->lastId++;}
			// On saute les nouvelles non concernées
			while (!feof($this->file) && $this->lastId < $id) {
				// Passe à la ligne suivante
				$line = fgets($this->file);
				// Recupere le type de la ligne
				$type = $line[0];
				// Regarde si on passe à la nouvelle suivante
				if ($type == 'T') {$this->lastId++;}
			}
			// Soit c'est la fin de fichier, soit la bonne news
			if (feof($this->file)) {
				return NULL;
			}
			// Ici normalement le type est T et $this->lastId = $id
			// Lecture de la news
			$line = substr($line,2);
			// Supprime les caractères blancs à la fin de la ligne
			$line=rtrim($line);
			// Le titre
			$titre = $line;
			// Lecture du contenu
			$line = fgets($this->file);
			// Recupere le type de la ligne
			$type = $line[0];
			// Prépare une variable pour le contenu
			$contenu = array();
			while (!feof($this->file) && ($type=='C')) {
				// Supprime le type (2 caractères)
				$line = substr($line,2);
				// Supprime les caractères blancs à la fin de la ligne
				$line=rtrim($line);
				array_push($contenu,$line);
				// Note la position de la ligne suivante
				$pos = ftell($this->file);
				// Passe à la ligne suivante
				$line = fgets($this->file);
				// Recupere le type de la ligne
				$type = $line[0];
				// Regarde si on passe à la nouvelle suivante
			}
			// feof($this->file) || ($type!='C')
			// Revient au début de la derniere ligne lue que si elle est pertinente
			if ($type != 'C') {
				fseek($this->file,$pos);
			}
			// Retourne la nouvelle
			return new News($id,$titre,$contenu);
		}
		
		// Ajoute une nouvelle à la fin
		function addNews(News $news // de type News
						 )
		{
			// Positionne le fichier à la fin
			fseek($this->file,0,SEEK_END); 
			$this->lastId=0;
			// L'ajoute au fichier avec le format
			fwrite($this->file,"T ".$news->titre."\n");
			// Recupère le contenu et place chaque ligne dans un tableau
			$content=preg_split("/[\n\r]+/",$news->contenu);
			// Le sort dans le fichier
			foreach($content as $line) {
				fwrite($this->file,"C ".$line."\n");
			}
		}
		
		// Rend invisible la news no $Id
		function delNews($id) 
		{
			// repart au début du fichier
			fseek($this->file,0); 
			$num = 0; // No du blog courant
			// Note la position de cette ligne
			$currentLine = ftell($this->file);
			$line = fgets($this->file);
			// Note la position de la ligne suivante
			$nextLine = ftell($this->file);
			while (!feof($this->file)) {
				// Recupere le type de la ligne
				$type = $line[0];
				// Regarde si c'est un titre
				if ($type == 'T') { $num++;}		
				if ($num == $id && ($type == 'T' || $type == 'C')) { 
					// Ligne à marquer detruite
					fseek($this->file,$currentLine);
					// Change juste les deux premiers caractères de la ligne
					fwrite($this->file,"#".$type);
					// reposition sur la ligne suivante
					fseek($this->file,$nextLine);
				}
				// Note la position de cette ligne
				$currentLine = ftell($this->file);
				$line = fgets($this->file);
				// Note la position de la ligne suivante
				$nextLine = ftell($this->file);
			}
			fseek($this->file,0); 
			$this->lastId =0;
		}
		
		// Annulle les suppressions
		function cancel () {
			// repart au début du fichier
			fseek($this->file,0); 
			// Note la position de la première ligne
			$currentLine = ftell($this->file);
			$line = fgets($this->file);
			// Note la position de la ligne suivante
			$nextLine = ftell($this->file);
			while (!feof($this->file)) {
				// Recupere le type de la ligne
				$type = $line[0];
				// Si la ligne était détruite
				if ($type=='#') {
					// revient au début de la ligne
					fseek($this->file,$currentLine);
					// replace le type annulé et l'espace
					fwrite($this->file,$line[1].' ');
					// reposition sur la ligne suivante
					fseek($this->file,$nextLine);
				}
				// Note la position de cette ligne
				$currentLine = ftell($this->file);
				$line = fgets($this->file);
				// Note la position de la ligne suivante
				$nextLine = ftell($this->file);
			}
			fseek($this->file,0); 
			$this->lastId =0;	
		}
		
	}
?>