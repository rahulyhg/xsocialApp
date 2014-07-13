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
		$this->current_row_html['news']=$this->model['name'];
		$this->current_row['news_img']=$this->model['news_img'];
	}

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

