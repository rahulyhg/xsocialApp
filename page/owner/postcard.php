<?php
class page_xsocialApp_page_owner_postcard extends page_xsocialApp_page_owner_main{
	function init(){
		parent::init();

		$btn=$this->add('Button')->addClass('btn btn-primary btn-xs')->set('manage post card');
			$btn->js('click')->univ()->frameURL('Create Post card' ,$this->api->url('xsocialApp_page_activitypages_cpc'));
	

	}
}		
		




