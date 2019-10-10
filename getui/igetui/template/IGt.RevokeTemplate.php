<?php

class IGtRevokeTemplate extends IGtBaseTemplate {
    /**
     *在没有找到对应的taskid，是否把对应appid下所有的通知都撤回 boolean
     */
    var $force = false;

    /**
     *根据oldTaskid进行撤回 string
     */
    var $oldTaskId;

	public function  getActionChain() {

		$actionChains = array();
		
		// 设置actionChain
		$actionChain1 = new ActionChain();
		$actionChain1->set_actionId(1);
  		$actionChain1->set_type(ActionChain_Type::mmsinbox2);
  		$actionChain1->set_stype("terminatetask");

        $f_force = new InnerFiled();
        $f_force->set_key("force");
        $f_force->set_val($this->force ? "true" : "false");
        $f_force->set_type(InnerFiled_Type::bool);
        $actionChain1->set_field(0, $f_force);

        $f_taskId = new InnerFiled();
        $f_taskId->set_key("taskid");
        $f_taskId->set_val($this->oldTaskId);
        $f_taskId->set_type(InnerFiled_Type::str);
        $actionChain1->set_field(1, $f_taskId);

        $actionChain1->set_next(100);

		//结束
        $actionChain2 = new ActionChain();
        $actionChain2->set_actionId(100);
        $actionChain2->set_type(ActionChain_Type::eoa);
 
		array_push($actionChains, $actionChain1,$actionChain2);

		return $actionChains;
	}

	function  get_pushType() {
		return 'Revoke';
	}

	function get_force(){
	    return $this->force;
    }

    function set_force($force){
	    $this->force = $force;
    }

    function get_oldTaskId(){
        return $this->oldTaskId;
    }

    function set_oldTaskId($oldTaskId){
        $this->oldTaskId = $oldTaskId;
    }
}



