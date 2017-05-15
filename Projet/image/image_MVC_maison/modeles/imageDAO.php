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
		const urlPath="http://php/image/image_MVC/model/IMG";

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
			$user = 'root';
			$pass = '';
			try {
				$this->db = new PDO('mysql:host=localhost;dbname=php_tp1', $user, $pass);
			} catch (PDOException $e) {
				die ("Erreur :".$e->getMessage());
			}
		}

		# Retourne le nombre d'images référencées dans le DAO
		function size() {
			// $result = $this->db->query('SELECT COUNT(*) FROM image');
			// return((int)$result->fetchColumn(0));
			// Correction prof
			$s = $this->db->query('SELECT * FROM image');
			$res = $s->fetchAll();
			return count($res);
		}

		# Retourne un objet image correspondant à l'identifiant
		function getImage($imgId) {
			$req = $this->db->query('SELECT * FROM image WHERE id='.$imgId);
			if ($req){
				$image = $req->fetchAll();
				return(new Image($this->path.'/'.$image[0]['path'], $imgId));
			} else {
				print "Error in getImage. id=".$imgId."<br/>";
				$err = $this->db->errorInfo();
				print $err[2]."<br/>";
			}
			// # Verifie que cet identifiant est correct
			// if(!($imgId >=1 and  $imgId <=$this->size())) {
			// 	$size=$this->size();
			// 	debug_print_backtrace();
			// 	die("<H1>Erreur dans ImageDAO.getImage: imgId=$imgId incorrect</H1>");
			// }
			//
			// return new Image(self::urlPath.$this->imgEntry[$imgId-1],$imgId);;
		}

		# Retourne une image au hazard
		function getRandomImage() {
			$randomId = rand(0, $this->size() - 1);
			return $this->getImage($randomId);
		}

		# Retourne l'objet de la premiere image
		function getFirstImage() {
			$req = "Select * from imageDB";
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
			$id = $img->getId();
			if ($id > 1){
				$img = $this->getImage($id-1);
			}
			return $img;
		}

		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img,$nb) {
			$imgId = $img->getId();
			$newImgId = $imgId + $nb;
			if ($newImgId < $this->size() && $newImgId > 0){
				return $this->getImage($imgId + $nb);
			} elseif (($imgId + $nb) < 1){
					return $this->getImage(1);
			} else {
				$jumpedImageId = $imgId + $nb - (size() - 1);
				return $this->getImage($jumpedImageId);
			}
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

		function getRandomImageList(image $img, $nb){
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			for($i = 1; $i <= $nb; $i++){
				$res[] = $this->getImage(rand(1, $this->size()));
				$i++;
			}
			return $res;
		}
	}

	?>
