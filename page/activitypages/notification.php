<?php

class page_xsocialApp_page_activitypages_notification extends Page{
	function init() {
		parent::init();
 
		$this->js(true,$this->js()->_selector('.notification')->trigger('reload'));

		$activity = $this->api->xsocialauth->model->getNotifications( false );
		$activity->setOrder('id','desc');
		$member=$this->add('xsocialApp/Model_MemberAll');
		foreach ( $activity as $junk ) {

			$v=$this->add('xsocialApp/View_Notifications_NotificationView')->setHtml($junk['name']);
			$btn=$v->add( 'View',null,'button')->set('show me')->addClass('btn btn-default');
									
			$v->add('xsocialApp/View_ProfilePic',array('member_id'=>$activity['from_member_id']),'profile_pic');
			$act_id = $activity['related_activity_id']?:$activity->id;
			$btn->js( 'click' )->univ()->frameURL( 'Notification', $this->api->url( 'xsocialApp_page_activitypages_activity', array( 'activity_id'=>$act_id)),array('width'=>'600px'));

		}

	}

}

