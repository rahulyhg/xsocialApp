 <?php

class page_xsocialApp_page_activitypages_cpc extends Page{
	function init() {
		parent::init();

		// post crad activity 
		$form=$this->add('Form');		
		$activity = $this->add('xsocialApp/Model_Activity');
		$post_card = $activity->loadActivity('PostCard');

		$form->setModel($post_card,array('name','img_id'));
		$form->addSubmit('Create Post card');

		$postcard_grid=$this->add('Grid');
		$postcard_grid->addPaginator(5);
		
		$postcard_grid->addColumn('template', 'type', false)->setTemplate('<img src="' .'logo'. 'icon_object_<?$type?>.png">');		
		
		$postcard_grid->setModel($activity->getPostCard($this->api->xsocialauth->model->id), array('name','img_id'));
			
		if($form->isSubmitted()){
			$post_card->createPostCard($form['name'],null,$form['img_id']);	
			$js=array(
				$this->api->js()->univ()->successMessage('Post Card Created Succesfully'),
				$form->js()->_selector('.activity')->trigger('reload')								
			);	

			$form->js(null,$js)->univ()->closeDialog()->execute();
			
		}		

	}

}	