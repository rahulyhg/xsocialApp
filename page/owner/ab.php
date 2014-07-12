<?php
class page_xsocialApp_page_owner_ab extends page_xsocialApp_page_owner_main{

	function init(){
		parent::init();

		$crud=$this->add('CRUD');

		$crud->setModel('xsocialApp/Model_Ab');
		$crud->addRef('xsocialApp/BImg',array('label'=>'Block Images'));
	}
}