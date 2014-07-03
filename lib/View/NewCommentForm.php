<?php
namespace xsocialApp;

class View_NewCommentForm extends \View{
	function init() {
		parent::init();		

		$new_comment = $this->add('xsocialApp/Model_Activity');

		$form=$this->add('Form');
		$form->setModel($new_comment,array('activity_detail','img_id'));
		$form->addField('hidden','commented_activity_id')->addClass('comment_activity_id_input');

		if($form->isSubmitted()){
			$comment=$this->add('xsocialApp/Model_Activity');
			$comment->load($form['commented_activity_id']);
			$activity = $comment->commented($form['activity_detail'],$form['img_id']);

			$new_activity = $this->add('xsocialApp/View_CommentView',array('activity_id'=>$activity->id,'comment_array'=>$activity));
			$new_activity_html = $new_activity->getHTML();

			$js=array(
					$form->js()->reload(),
					$this->js()->univ()->successMessage('You Just Updated Your Status'),
					$this->js()->_selector('.comments-block-'.$form['commented_activity_id'])->prepend($new_activity_html)
				);
			$this->js(true,$js)->execute();			
		}
	}
}
