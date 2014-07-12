<?php

class page_xsocialApp_page_activitypages_editactivity extends Page{
	function init(){
		parent::init();

		$this->api->stickyGET('activity_id');
	
		
		$activity=$this->add('xsocialApp/Model_Activity');
		$activity->load($_REQUEST['activity_id']);
		
		// check if my Activity ;) Hacking Attempt Found ... 

		if($activity['from_member_id'] != $this->api->xsocialauth->model->id){
			echo $this->js(true)->univ()->errorMessage('Itne Shane tum hi ho kya ...');
			exit;
		}
		
		$activity['activity_detail'] = $_REQUEST['say_something'];
		if($_REQUEST['visibility'])
			$activity['visibility'] = $_REQUEST['visibility'];
		
		$activity->save();
		// throw new \Exception($_REQUEST['activity_id'], 1);
		
		echo $this->js(true)->_selector('#activity_view_'.$_REQUEST['activity_id'])->trigger('reload');
		exit;
		}
}
