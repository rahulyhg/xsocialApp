<?php

class page_xsocialApp_page_likers extends Page {
	function init(){
		parent::init();

		if(!$_GET['activity_id'])
			throw $this->exception('activity_id is not defined')->addMoreInfo("In View", $this->owner);

		$activity=$this->add('xsocialApp/Model_Activity');
		$activity->load($_GET['activity_id']);
		$likers=$activity->whoLikeText(true);
		$likers_array=explode(',',$likers);
		
		foreach ($likers_array as $value) {
			preg_match_all('/profile_of=(.*)"/', $value, $mamber_id_array);
			$members=$this->add('xsocialApp/Model_MemberAll');
			$members->load($mamber_id_array[1][0]);
			$v=$this->add('xsocialApp/View_Lister_Liker');
			$v->add('xsocialApp/View_ProfilePic',array('member_id'=>$mamber_id_array[1][0]),'profile_pic');
			$v->template->setHtml('member_name',$value);

		}
		
	}
}