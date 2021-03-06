<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {
		
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin LOCAL où se trouvent les images
		private $path="model/IMG";
		# Chemin URL où se trouvent les images
		const urlPath="http://php/image/image_base/image/model/IMG";
		
		# Tableau pour stocker tous les chemins des images
		private $imgEntry;
		
		# Lecture récursive d'un répertoire d'images
		# Ce ne sont pas des objets qui sont stockes mais juste
		# des chemins vers les images.
		private function readDir($dir) {
			# build the full path using location of the image base
			$fdir=$this->path.$dir;
			if (is_dir($fdir)) {
				$d = opendir($fdir);
				while (($file = readdir($d)) !== false) {
					if (is_dir($fdir."/".$file)) {
						# This entry is a directory, just have to avoid . and .. or anything starts with '.'
						if (($file[0] != '.')) {
							# a recursive call
							$this->readDir($dir."/".$file);
						}
					} else {
						# a simple file, store it in the file list
						if (($file[0] != '.')) {
							$this->imgEntry[]="$dir/$file";
						}
					}
				}
			}
		}
		
	
		
		function __construct() {
			$this->readDir("");
		}
		
		# Retourne le nombre d'images référencées dans le DAO
		function size() {
			return count($this->imgEntry);
		}
		
		# Retourne un objet image correspondant à l'identifiant
		function getImage($imgId) {
			# Verifie que cet identifiant est correct
			if(!($imgId >=1 and  $imgId <=$this->size())) {
				$size=$this->size();
				debug_print_backtrace();
				die("<H1>Erreur dans ImageDAO.getImage: imgId=$imgId incorrect</H1>");
			}
			
			return new Image(self::urlPath.$this->imgEntry[$imgId-1],$imgId);;
		}
		
		
		# Retourne une image au hazard
		function getRandomImage() {
			trigger_error("Non réalisé");		
		}
		
		# Retourne l'objet de la premiere image
		function getFirstImage() {
			return $this->getImage(1);
		}
		
		# Retourne l'image suivante d'une image
		function getNextImage(image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}
			return $img;
		}
		
		# Retourne l'image précédente d'une image
		function getPrevImage(image $img) {
			trigger_error("Non réalisé");
		}
		
		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img,$nb) {
			trigger_error("Non réalisé");
		}
		
		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img,$nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}
	}
	
	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage("");
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";
	}
	
	
	?>