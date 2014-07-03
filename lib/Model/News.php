<?php
namespace xsocialApp;
class Model_News extends \Model_Table {
	var $table= "xsocialApp_news";
	function init(){
		parent::init();

		$this->hasOne('xsocialApp/NewsCategory','news_catgory_id');
		$this->addField('name')->type('text');
		$this->addField('created_on')->type('date')->defaultValue(date('Y-m-d'));
		$this->add('filestore/Field_Image','new_img_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}