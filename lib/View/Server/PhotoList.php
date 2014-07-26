<?php

namespace xsocialApp;

class View_Server_PhotoList extends \View{
	function init(){
		parent::init();
				
	$images=$this->add('xsocialApp/Model_Activity');
	$member=$this->add('xsocialApp/Model_MemberAll');
	
	if($_GET['profile_of'])
		$member->load($_GET['profile_of']);
	else
		$member->load($this->api->xsocialauth->model->id);

	$images->addCondition('from_member_id',$member->id);
	$images->addCondition('img_id','<>',null);
	
	$count= $images->count()->getOne();

	$images->setLimit(6);
	$images->setOrder('id','desc');
	
	$photolist=$this->add('xsocialApp/View_Photo_List');
	$photolist->setModel($images);

	$photolist->template->trySet('count',$count);
	}

	
}