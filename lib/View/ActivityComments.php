<?php

namespace xsocialApp;

class View_ActivityComments extends \View{
	public $activity_id;

	function init(){
		parent::init();
		// $this->addClass('comments-block-'.$this->activity_id);
		$this->js('reload')->reload();
	}

	function recursiveRender(){
		$max_limit=3;
		if($_GET['show_all_comments']){
			$max_limit=null;
		}

		$this_activity_comments = $this->add('xsocialApp/Model_Activity');
		$this_activity_comments->loadComments($this->activity_id, $max_limit);

		foreach ($this_activity_comments as $comment) {
			$this->add('xsocialApp/View_CommentView',array('activity_id'=>$this_activity_comments->id,'comment_array'=>$comment));
		}
		
		if($max_limit){
			$v=$this->add('View')->setHtml("See All Comments");
			$this->template->trySet('see_all',$v);
			$v->js( 'click' )->univ()->frameURL( 'Activity', $this->api->url( 'xsocialApp_page_activitypages_activity', array( 'activity_id'=>$this->activity_id,'show_all_comments'=>1)));
		}


		parent::recursiveRender();
	
	}	
}	