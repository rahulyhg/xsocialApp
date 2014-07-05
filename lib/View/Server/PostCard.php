<?php

namespace xsocialApp;

class View_Server_PostCard extends \View{
	function init(){
		parent::init();

		$btn=$this->add('Button')->addClass('btn btn-primary')->set('manage post card');
		
		$btn->js('click')->univ()->frameURL('Create Post card' ,$this->api->url('xsocialApp_page_activitypages_cpc'));
   	
	}

}