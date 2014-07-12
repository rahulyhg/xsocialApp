<?php

namespace xsocialApp;

class View_Server_Ab extends \View{

	function init(){
		parent::init();

		$add_blocks = $this->add('xsocialApp/Model_Ab');

		$i=0;
		foreach ($add_blocks as $junk) {
			$lister = $this->add('xsocialApp/View_Lister_Ab');
			$images = $this->add('xsocialApp/Model_BImg');
			$images->addCondition('block_id',$add_blocks->id);
			$lister->setModel($images);
			$lister->addClass('.carousel-'.$i);
			$this->js(true)->carousel('.carousel-'.$i,$add_blocks['add_rotate_timing']*1000);
			$i++;
		}
	}
	
}	