<?php

class page_xsocialApp_page_activitypages_rps extends Page{
	function init(){
		parent::init();


	$points=$this->api->xsocialauth->model->ref('xsocialApp/PointTransaction');
	$grid=$this->add('Grid');
	$grid->setModel($points,array('point','points','on_date'));	
		
	
	}
}		