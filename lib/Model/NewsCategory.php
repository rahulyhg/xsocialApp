<?php
namespace xsocialApp;
class Model_NewsCategory extends \Model_Table {
	var $table= "xsocialApp_news_category";
	function init(){
		parent::init();

		$this->addField('name');
		$this->hasMany('xsocialApp/News','news_catgory_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	

}