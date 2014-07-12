<?php
class page_xsocialApp_page_news_category extends Page {
	function init(){
		parent::init();


		$categories = $this->add('xsocialApp/Model_NewsCategory');

			$tabs=$this->add('Tabs');
		foreach ($categories as $category) {
				$tab=$tabs->addTab($categories['name']);		

			// $btn->js('click',$v->js()->reload(array('')))
			$new_view=$tab->add('xsocialApp/View_News_List');
			$news=$this->add('xsocialApp/Model_News');
			$news->addCondition('news_catgory_id',$categories->id);
			if(!$news->count()->getOne())
				$tab->add('View_Info')->set('No News available for this category');
			$news->setOrder('created_on','desc');
			$new_view->setModel($news);
			$new_view->js(true)->_selector('.newscarousel')->carousel();
			

			}
			
	}
}