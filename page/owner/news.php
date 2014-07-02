<?php
class page_xsocialApp_page_owner_news extends page_xsocialApp_page_owner_main{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$newscategory=$this->add('xsocialApp/Model_NewsCategory');
		$crud->setModel($newscategory);
		$crud->addRef('xsocialApp/News');

	}
}