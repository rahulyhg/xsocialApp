<?php

class page_xsocialApp_page_activitypages_newstatus extends Page{
	function init(){
		parent::init();
		
		$activity=$this->add('xsocialApp/Model_Activity');
		$activity['asdfas'] = $_REQUEST['sdfsdf'];

		$new_activity = $this->add('xsocialApp/View_Activity',array('activity_id'=>$activity->id,'activity_array'=>$activity));
		$new_activity_html = $new_shared_activity->getHTML();

		$js=array(
				$this->js()->univ()->successMessage('You Just Updated Your Status'),
				$this->js()->_selector('.activity-list')->prepend($new_activity_html)
			);
		echo $this->js(true,$js);
		exit;
	}
}