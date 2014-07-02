<?php

namespace xsocialApp;

class View_Server_NewsBlock extends \View{

	function init(){
		parent::init();

		$new_view=$this->add('xsocialApp/View_News_List');
		$news=$this->add('xsocialApp/Model_News');
		$news->addCondition('news_catgory_id',$this->api->xsocialauth->model->getSubscribedCategory());
		$news->setOrder('created_on','desc');
		$new_view->setModel($news);
		$new_view->js(true)->_selector('.newscarousel')->carousel();
		
	}
	
}	