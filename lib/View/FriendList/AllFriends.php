<?php

namespace xsocialApp;

class View_FriendList_AllFriends extends \CompleteLister{
public $profile_pic;

	function formatRow(){
		$this->current_row_html['url']=$this->api->url(null,array('subpage'=>'xsocial-profile','profile_of'=>$this->model->id));
		if(!$this->model['profile_pic_id']){
			if($this->model['gender']=='Male')
				$this->current_row['profile_pic']='male.png';
			else
				$this->current_row['profile_pic']='female.png';
		}
	}

	
	

	
	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/xsocial-allfriendslist');
	}


}

