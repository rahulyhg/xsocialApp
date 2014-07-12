<?php

namespace xsocialApp;

class Plugins_cropImagePlugin extends \componentBase\Plugin{
	public $namespace = 'xsocialApp';

	function init(){
		parent::init();	
		$this->addHook('website-page-loaded',array($this,'CropImage'));
	}

	function CropImage(){
		if($_GET['crop_image']){
				
			$targ_w = $_GET['w'];
			$targ_h = $_GET['h'];

			$jpeg_quality = 90;

			$old_dir = getcwd();
			chdir('..');
			$src = getcwd() . $this->api->xsocialauth->model['timeline_pic'];
			chdir($old_dir);

			$aSize = getimagesize($src);
			switch ($aSize[2]) {
				case IMAGETYPE_JPEG:
					$type='jpeg';
					break;
				case IMAGETYPE_PNG:
					$type='png';
					$jpeg_quality=0;
					break;
				case IMAGETYPE_GIF:
					$type='gif';
					break;
				default:
					# code...
					break;
			}
			$func = "imagecreatefrom".$type;
			$img_r = $func($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			
			imagecopyresampled($dst_r,$img_r,0,0,$_GET['x'],$_GET['y'],
			    $targ_w,$targ_h,$_GET['w'],$_GET['h']);

			// header('Content-type: image/jpeg');
			
			$func="image".$type;
			

			$func($dst_r, $src, $jpeg_quality,null);
			
			// $this->js()->reload()->execute();				
			echo $this->js(true)->_selector('.profilecover')->trigger('reload');
			exit;
		}
	}
	
	function getDefaultParams($new_epan){}
}