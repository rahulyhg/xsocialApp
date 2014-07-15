<?php

namespace xsocialApp;


class View_Notifications_Friends_Request extends \View{
	public $request_from_id;
	function init(){
		parent::init();
		$cols= $this->add('Columns');
		$profile_col  = $cols->addColumn(2);
		$details_col = $cols->addColumn(8);


		$member=$this->add('xsocialApp/Model_MemberAll');
		$profilePic = $profile_col->add('xsocialApp/View_ProfilePic',array('member_id'=>$this->request_from_id))->addStyle(array("width"=>'60%',"height"=>'80px;'))->addClass('img-thumbnail img-circle ');

		$details_col->add('View')->setHtml($member->linkfyFriendRequestText($profilePic->member['name']))->addStyle('text-transform','uppercase')->addClass('well well-sm');
		
		$details_col->add('xsocialApp/View_FriendsBtn_PendingApproval',array('member'=>$profilePic->member));

	}
}