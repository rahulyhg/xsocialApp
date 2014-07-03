<?php
class page_xsocialApp_page_news_category extends Page {
	function init(){
		parent::init();


		$categories = $this->add('xsocialApp/Model_NewsCategory');
		$subcribed_category_model = $this->add('xsocialApp/Model_NewsCategorySubscribeMember');

		foreach ($categories as $category) {
			$btn = $this->add('MyButton')->set($categories['name']);
			if($subcribed_category = $subcribed_category_model->isAvailable($categories)){
				$btn->addClass('btn btn-info');
			}else{
				$btn->addClass('btn btn-warning');		

			}

			if($btn->isClicked()){
				if($subcribed_category){
					$subcribed_category->remove();
				}else{
					$subcribed_category_model->creatNew($categories);
				}
				$btn->js()->reload()->execute();
			}

		}
	}
}