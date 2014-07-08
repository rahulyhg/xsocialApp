<?php

namespace xsocialApp;

class View_News_List extends \CompleteLister{
	public $is_active_marked=false;
	function formatRow(){
		// $this->current_row['link']=$this->model['link'];
		if(!$this->is_active_marked){
			$this->current_row['active_class'] ='active';
			$this->is_active_marked=true;
		}else{
			$this->current_row['active_class']='';
		}
	}

	// function setModel($model){
	// 	parent::setModel($model);
	// 	throw new \Exception($model['name'], 1);
		
	// 	$this->template->setHtml('news',$model['name']);
	// }


	
	
	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/xsocial-news');
	}


}

