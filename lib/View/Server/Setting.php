<?php

namespace xsocialApp;

class View_Server_Setting extends \View{
function init(){
	parent::init();

		$tab=$this->add('Tabs');
		$tab_chgpassword=$tab->addTab('Change Password');
		$tab_chgpassword->add('View_Info')->set($this->api->cu_emailid);
		$form=$this->add('Form');	
		$form->addField('password','old_password')->validateNotNull('Required Field');
		$form->addField('password','new_password')->validateNotNull('Required Field');
		$form->addField('password','retype_new_password')->validateNotNull('Required Field');

		$form->addSubmit('Save Changes');

		if($form->isSubmitted()){
			// throw new \Exception($this->api->cu_id);
			
			$member=$this->add('xsocialApp/Model_MemberAll')->load($this->api->cu_id);

			if($form['new_password'] != $form['retype_new_password']){	
				//$form->js()->univ()->errorMessage('Re-type Password')->execute();
				$form->displayError('new_password','Password Not match');						
			}
			
			if($member->changePassword($form['old_password'],$form['new_password'])){
				$form->js(true,$this->js()->univ()->successMessage('Password Change Success fully'))->reload()->execute();
			}
			else
				$form->displayError('old_password','Password is worng');


		}
	}
}