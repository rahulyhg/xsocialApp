<?php

namespace xsocialApp;

class Model_PointTransaction extends \Model_Table{
	public $table="xsocialApp_points_transaction";

	function init(){
		parent::init();

		$this->hasOne('xsocialApp/Point','point_id')->caption('Activity');
		$this->hasOne('xsocialApp/MemberAll','member_id');
		$this->addField('points');
		$this->addField('remark');
		$this->addField('on_date')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
		$this->add('dynamic_model/Controller_AutoCreator');
		
	}

	function createNew($point,$member_id,$remark,$on_date=null){
		if($this->loaded())
			throw new \Exception("Use Empty Model Object");
		$this['point_id']=0;
		$this['member_id']=$member_id;
		$this['points']=$point;
		$this['remark']=$remark;
		$this['on_date']=$on_date;
		$this->save();
		return $this;
			
	}
}