<?php

namespace xsocialApp;

class Model_BImg extends \Model_Table{
	var $table="xsocial_bimg";
	function init(){

		parent::init();
		$this->hasOne('xsocialApp/Ab','block_id');

		$this->add('filestore/Field_Image','blockimg_id');
		$this->addField('link')->caption('Web Link');

		$this->addExpression('block_name')->set(function($m,$q){
			return $m->refSQL('block_id')->fieldQuery('name');
		});

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}