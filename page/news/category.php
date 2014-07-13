<?php
class page_xsocialApp_page_news_category extends Page {
	function init(){
		parent::init();


		$categories = $this->add('xsocialApp/Model_NewsCategory');

		$subscribe=$this->add('xsocialApp/Model_NewsCategorySubscribeMember');

		foreach ($categories as $category) {
			$btn = $this->add('MyButton')->set($categories['name']);
			if($subscribe_cat = $subscribe->isAvailable($categories)){
				$btn->addClass('btn btn-info');
			}else{
				$btn->addClass('btn btn-warning');		

			}

			if($btn->isClicked("Are you sure")){
				if($subscribe_cat){
					$subscribe->remove();
				}else{
					$subscribe->createNew($categories);
				}
				$btn->js()->reload()->execute();
			}

		}
			

			// $btn->js('click',$v->js()->reload(array('')))
			$new_view=$this->add('xsocialApp/View_News_List');
			
			$news=$this->add('xsocialApp/Model_News');
			$news->addCondition('news_catgory_id',$this->api->xsocialauth->model->getSubsribedNewsIDs());
			// $news->addCondition('news_catgory_id',$categories->id);
			if($news->count()->getOne() == 0)
				$this->add('View_Info')->set('No News available for this category');
			$news->setOrder('created_on','desc');
			$new_view->setModel($news);
			$new_view->js(true)->_selector('.newscarousel')->carousel();
			

			
			
	}
}