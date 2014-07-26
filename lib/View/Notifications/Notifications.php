<?php

namespace xsocialApp;

class View_Notifications_Notifications extends \View{

function init(){
	parent::init();

	$user=$this->api->xsocialauth->model;
	// $member=$this->add('xsocialApp/Model_MemberAll');
	if($_GET['notification_reloaded']){
		$user->getNotified($_GET['till_id']);
	}

	$count=$user->getNotifications(true);
	
	if($count['count'] > 0)
		$this->add('View')->set($count['count'])->setStyle('background','#A81010');
	else	
		$this->add('View')->set($count['count']);
	
	
	$this->js('click')->_selector('.notification-toolbar-li')->univ()->frameURL('Notifications',$this->api->url('xsocialApp_page_activitypages_notification'),array('width'=>'600px'));
	
	$this->addClass('notification');
	$this->js('reload')->reload(array('notification_reloaded'=>1,'till_id'=>$count['max_id']));
	}
}
