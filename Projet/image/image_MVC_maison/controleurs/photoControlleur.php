<?php
require_once('vues/principaleVue.php');

/*
require_once('data.php');
require_once('model/image.php');
require_once('model/imageDAO.php');

echo ' - photoControlleur - ';


class Photo {

	public function __construct()
	{
		$this->imgDAO = new ImageDAO();
	}

	public function getParam()
	{
		global $imageId$size,$zoom;

		if(isset($_GET['imageId']))
		{
			$imageId=$_GET['imageId'];
		}
		else
		{
			$imageId=1;
		}

		if(isset($_GET['size']))
		{
			$size=$_GET['size'];
		}
		else
		{
			$size=480;
		}

		if(isset($_GET['zoom']))
		{
			$zoom=$_GET['zoom'];
		}
		else
		{
			$zoom=1.0;
		}
	}

	protected function setMenuView()
	{
		global $imageId,$size,$zoom,$data;
		$data->menu['Home']="index.php";
		$data->menu['First']="index.php?controller=photo&action=first&imageId=$imageId&size=$size&zoom=$zoom";
		$data->menu['Random']="index.php?controller=photo&action=first&imageId=$imageId&size=$size&zoom=$zoom";
		$data->menu['More']="index.php?controller=photo&action=first&imageId=$imageId&size=$size&zoom=$zoom";
		$data->menu['Zoom +']="index.php?controller=photo&action=first&imageId=$imageId&size=$size&zoom=$zoom";
		$data->menu['Zoom -']="index.php?controller=photo&action=first&imageId=$imageId&size=$size&zoom=$zoom";
	}

	public function setContentView()
	{
		$data->content = "photoView.php";
		$img=$this->imgDAO->getImage($imageId);
		$data->imageURL=$img->getURL5°.
		$data->size=$size;
		$data->prevURL="index.php?controller=photo&action=prev&imageId=$imageId&size=$size&zoom=$zoom";
		$data->nextURL="index.php?controller=photo&action=next&imageId=$imageId&size=$size&zoom=$zoom";
	}

	public function next()
	{
		//à écrire
	}

	public function prev()
	{
		//à écrire
	}

	public function index()
	{
		//$this->
	}
}

*/
?>