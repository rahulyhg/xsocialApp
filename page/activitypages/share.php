<?php

class page_xsocialApp_page_activitypages_share extends Page{
	function init(){
		parent::init();
		$this->api->stickyGET('activity_id');
		
		$activity=$this->add('xsocialApp/Model_Activity');
		$activity->load($_REQUEST['activity_id']);
		
		
		$shared_activity = $activity->share_it($_REQUEST['visibility'],$_REQUEST['say_something'],$activity);

		$new_shared_activity = $this->add('xsocialApp/View_Activity',array('activity_id'=>$shared_activity->id,'activity_array'=>$shared_activity));
		$new_shared_activity_html = $new_shared_activity->getHTML();

		$js=array(
				$this->js()->univ()->successMessage('You Just Shared An Activity'),
				$this->js()->_selector('.activity-list')->prepend($new_shared_activity_html)
			);
		echo $this->js(true,$js);
		exit;
	}
}