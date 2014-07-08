<?php

namespace xsocialApp;

class View_Server_NewsBlock extends \View{

	function init(){
		parent::init();

	$btn=$this->add('Button')->setStyle('margin-top','5px')->addClass('btn btn-warning')->set('Manage News');
		
		$btn->js('click')->univ()->frameURL('News' ,$this->api->url('xsocialApp_page_news_category'));

	}
	
}	