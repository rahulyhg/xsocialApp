<?php

class page_xsocialApp_page_activitypages_profilecover extends Page{
	function init(){
		parent::init();

		$short_name = 'cp';
		unset($this->owner->elements[$this->short_name]);
        $this->name = 't1' . '_' . $short_name;
        $this->short_name = $short_name;
        
        if (!$this->auto_track_element) {
            $this->owner->elements[$short_name] = true;
        } else {
            $this->owner->elements[$short_name] = $this;
        }

		$images=$this->add('xsocialApp/Model_Images');
		// throw new \Exception("Error Processing Request", 1);
		$images->addCondition('member_id',$_GET['member_id']);
		
		$form=$this->add('Form');
		// $form->addField('upload','timeline_pic');
		$form->setModel($images,array('img_id'));
		$form->addSubmit('Update Cover Page');

		if($form->isSubmitted()){
			if(!$form['img_id'])
				$form->displayError('img_id','please select');

			$form->update();

			if($activity=$this->api->xsocialauth->model->updateCoverPage($form->getAllFields()))
				$new_activity = $this->add('xsocialApp/View_Activity',array('activity_id'=>$activity->id,'activity_array'=>$activity));
				$new_activity_html = $new_activity->getHTML();
				$form->js(null,array(
								$this->js()->_selector('.profilecover')->trigger('reload'),
								$this->js()->_selector('.activity-list')->prepend($new_activity_html)

							))->univ()->closeDialog()->execute();
		}

	}
}
