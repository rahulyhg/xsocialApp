<?php
namespace xsocialApp;
class Model_NewsCategorySubscribeMember extends \Model_Table {
	var $table= "xsocialApp_newscategory_subscribe_members";
	function init(){
		parent::init();

		$this->hasOne('xsocialApp/NewsCategory','news_category_id');
		$this->hasOne('xsocialApp/MemberAll','member_id');
		$this->addField('subscribe_on')->type('date')->defaultValue(date('Y-m-d'));


		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function createNew($catgory){
		if($this->loaded())
			throw $this->exception('You can not use loaded Model');
		$this['news_category_id']=$catgory->id;
		$this['member_id']=$this->api->xsocialauth->model->id;
		$this->save();
	}

	function remove(){
		if(!$this->loaded())
			throw $this->exception('Unable to determine, Which record delete');
		$this->delete();
		return true;
	}

	function isAvailable($catgory){
		$subscribe_category=$this->add('xsocialApp/Model_NewsCategorySubscribeMember');
		$subscribe_category->addCondition('news_category_id',$catgory->id);
		$subscribe_category->addCondition('member_id',$this->api->xsocialauth->model->id);
		$subscribe_category->tryLoadAny();
		if($subscribe_category->loaded())
			return $subscribe_category;
		else
			return false;

	}
}