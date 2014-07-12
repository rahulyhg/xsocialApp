<?php

namespace xsocialApp;

class View_Server_Login extends \View{
	function init(){
		parent::init();
		
		// If already logged in redirect to dashboard
		if($this->api->recall('logged_in_social_user',false))
			$this->api->redirect($this->api->url(null,array('subpage'=>'xsocial-dashboard')));

		// $this->add('p')->set('Login Form');
		$form=$this->add('Form',null,null,array('form_horizontal'));
		$form->addField('line','emailID','Email Id')->validateNotNull('Required Field');
		$form->addField('password','password','Password')->validateNotNull('Required Field');
		// $form->addSubmit('login');

		$form->add('Button')->set('Login')
		->addStyle(array('margin-top'=>'25px','margin-left'=>'37px'))
			->js('click')->submit();
		
		if($_GET['oauth_login']){
			$config = getcwd() . '/lib/hybridauth/hybridauth/config.php';
				require_once( getcwd()."/lib/hybridauth/hybridauth/Hybrid/Auth.php" );
				try{
					
					$hybridauth = new \Hybrid_Auth( $config );

					$adapter = $hybridauth->authenticate( $_GET['oauth_login'] );
					
					$user_profile = $adapter->getUserProfile();
					
				}
				catch( Exception $e ){
					die( "<b>got an error!</b> " . $e->getMessage() ); 
				}

				if(true){
					$oAuth_email = $user_profile->email;
				// if user is logged in 
					// try load such user from existing members
					$existing_member = $this->add('xsocialApp/Model_MemberAll');
					$existing_member->tryLoadBy('emailID',$oAuth_email);
					if(!$existing_member->loaded()){
						// if not found
						// create one
						$details= array(
								'first_name'=>$user_profile->firstName,
								'last_name'=>$user_profile->lastName,
								'password'=>rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999),
								'emailID'=>$user_profile->email,
								'gender'=>$user_profile->gender=='male'?'Male':'Female',
								'date_of_birth'=>$user_profile->birthYear . '-'.$user_profile->birthMonth . '-'.$user_profile->birthDay
							);
						$existing_member->register($details);
					}
					if(!$existing_member['is_verify']){
						// check if verified .. if not do so .. we trust facebook :)
						$existing_member->veryfyMember();
					}
					// login the member
					$this->api->memorize('logged_in_social_user',$existing_member['emailID']);
					// redirect to dashboard
					$this->api->redirect($this->api->url(null,array('subpage'=>'xsocial-dashboard')));
				}
		}

		// Redirect to Verify Account
		$fb_login_btn=$this->add('Button')->set('Login Via FB')->addClass('btn btn-default btn-xs');
			if($fb_login_btn->isClicked()){
				$this->api->redirect($this->api->url(null,array('oauth_login'=>'facebook')));
		 	}

 		$google_login_btn=$this->add('Button')->set('Login Via Google')->addClass('btn btn-default btn-xs');
			if($google_login_btn->isClicked()){
				$this->api->redirect($this->api->url(null,array('oauth_login'=>'google')));
		 	}


		$verify_btn=$this->add('Button')->set('Verification')->addClass('btn btn-default btn-xs');
			if($verify_btn->isClicked()){
				$this->api->redirect($this->api->url(null,array('subpage'=>'xsocial-verifyaccount')));
		 	}

		if($form->isSubmitted()){
			$member=$this->add('xsocialApp/Model_AllActiveMembers');
		 	if(!$member->tryLogin($form['emailID'],$form['password']))
		 		$form->displayError('emailID','wrong username');
		 		
				// Redirect to Dashboard
				$this->js()->univ()->redirect($this->api->url(null,array('subpage'=>'xsocial-dashboard')))->execute();
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
		return array('view/xsocial-login');
	}
}
