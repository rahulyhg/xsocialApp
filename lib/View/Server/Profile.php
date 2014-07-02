<?php

namespace xsocialApp;

class View_Server_Profile extends \View{
	public $member_id=null;
	public $profile_pic_url=false;
	public $member=null;
	public $member_gender=null;
	function init(){
		parent::init();		
		
		$this->add('Button')->set('Edit');
				
	}

	function recursiveRender(){
		$profile_of= $_GET['profile_of'];
		if(!$profile_of) $profile_of=$this->api->xsocialauth->model->id;
		
		// TODO :: Check if member is already set by some other means and we are overridding
		// it here.. Wrong Profile Pic ???
		$this->member = $member=$this->add('xsocialApp/Model_AllVerifiedMembers');
		$member->tryLoad($profile_of);


		// throw new \Exception($member['profile_pic']);
		if($member['profile_pic']){
				$src=$member['profile_pic'];
				$this->template->set('member_pic',$member['profile_pic']);
			}else{
				if($this->member['gender']=='Female'){
						$src='female.png';
						$this->template->set('member_pic',$src);
					}
				else{
					$src="male.png";			
					$this->template->set('member_pic',$src);
				}		
			}
		
		$this->template->set('member_name',$member['name']);
		parent::recursiveRender();
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
		return array('view/xsocial-profile');
	}

}