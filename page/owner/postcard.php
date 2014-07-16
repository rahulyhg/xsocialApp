<?php
class page_xsocialApp_page_owner_postcard extends page_xsocialApp_page_owner_main{
	function init(){
		parent::init();

		// $btn=$this->add('Button')->addClass('btn btn-primary btn-xs')->set('manage post card');
		// 	$btn->js('click')->univ()->frameURL('Create Post card' ,$this->api->url('xsocialApp_page_activitypages_cpc'));
		$activity = $this->add('xsocialApp/Model_Activity');
		$post_card = $activity->loadActivity('PostCard');
		$form=$this->add('Form');
		$form->setModel($post_card,array('name','img_id'));
		$form->addSubmit('Create Post card');
			
		$crud=$this->add('CRUD',array('allow_add'=>false));
		$crud->setModel($post_card,array('name','img_id'),array('name','img','created_at'));

		if($crud->grid){
			$crud->grid->addMethod('format_picture', function($g,$f){
			$g->current_row_html[$f]='<a target="_blank" 
									  href=" '.$g->current_row[$f].'
									   "</a>'.'<img src=" '
									   .$g->current_row[$f].' 
									   "width="60px" height="60px" / >';	
			});
			$crud->grid->addFormatter('img','picture');
		}	

			
		if($form->isSubmitted()){
			$post_card->createPostCard($form['name'],null,$form['img_id']);	
			$js=array(
				$this->api->js()->univ()->successMessage('Post Card Created Succesfully'),
				$form->js()->_selector('.activity')->trigger('reload')->reload(),
				$crud->grid->js(true)->reload()
			);	
			
			$form->js(true,$js)->reload()->execute();
			
		}
			
			
	}
}		
		




