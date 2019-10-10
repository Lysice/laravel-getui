<?php

class IGtLinkTemplate extends IGtBaseTemplate {

	/**
	*String 
	*/
	var $text;

	/**
	*String 
	*/
	var $title;

	/**
	*String 
	*/
	var $logo;
	
	var $logoURL;

	/**
	*boolean 
	*/
	var $isRing;

	/**
	*boolean 
	*/
	var $isVibrate;

	/**
	*String 
	*/
	var $url;
	
	/**
	*boolean 
	*/
	var $isClearable;

	/**
	*int
	*/
	var $notifyStyle = 0;

    /**
     * 用于消息覆盖
     */
    var $notifyId;

    /**
     *String  Android 8.0 新增字段
     */
    var $channel = "Default";

    /**
     *String Android 8.0 新增字段
     */
    var $channelName = "Default";

    /**
     *int Android 8.0 新增字段
     */
    var $channelLevel = 3;

	public function  getActionChain() {

		$actionChains = array();
		
		// 设置actionChain
		$actionChain1 = new ActionChain();
		$actionChain1->set_actionId(1);
  		$actionChain1->set_type(ActionChain_Type::refer);
		$actionChain1->set_next(10000);
		
		//通知
		$actionChain2 = new ActionChain();
		$actionChain2->set_actionId(10000);
		$actionChain2->set_type(ActionChain_Type::mmsinbox2);
		$actionChain2->set_stype("notification");

        $f_notifyId = new InnerFiled();
        $f_notifyId->set_key("notifyid");
        $f_notifyId->set_val(empty($this->notifyId)?"":$this->notifyId);
        $f_notifyId->set_type(InnerFiled_Type::str);
        $actionChain2->set_field(0, $f_notifyId);

		$f_text = new InnerFiled();
		$f_text->set_key("text");
		$f_text->set_val($this->text);
		$f_text->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(1, $f_text);
		
		$f_title = new InnerFiled();
		$f_title->set_key("title");
		$f_title->set_val($this->title);
		$f_title->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(2, $f_title);
		
		$f_logo = new InnerFiled();
		$f_logo->set_key("logo");
		$f_logo->set_val($this->logo);
		$f_logo->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(3, $f_logo);
		
		$f_logoURL = new InnerFiled();
		$f_logoURL->set_key("logo_url");
		$f_logoURL->set_val($this->logoURL);
		$f_logoURL->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(4, $f_logoURL);
		
		$f_notifyStyle = new InnerFiled();
		$f_notifyStyle->set_key("notifyStyle");
		$f_notifyStyle->set_val(strval($this->notifyStyle));
		$f_notifyStyle->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(5, $f_notifyStyle);
		
		$f_isRing = new InnerFiled();
		$f_isRing->set_key("is_noring");
		$f_isRing->set_val(!$this->isRing ? "true" : "false");
		$f_isRing->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(6, $f_isRing);
		
		$f_isVibrate = new InnerFiled();
		$f_isVibrate->set_key("is_novibrate");
		$f_isVibrate->set_val(!$this->isVibrate ? "true" : "false");
		$f_isVibrate->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(7, $f_isVibrate);
		
		$f_isClearable = new InnerFiled();
		$f_isClearable->set_key("is_noclear");
		$f_isClearable->set_val(!$this->isClearable ? "true" : "false");
		$f_isClearable->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(8, $f_isClearable);

        $f_channel = new InnerFiled();
        $f_channel->set_key("channel");
        $f_channel->set_val($this->channel);
        $f_channel->set_type(InnerFiled_Type::str);
        $actionChain2->set_field(9, $f_channel);

        $f_channelName = new InnerFiled();
        $f_channelName->set_key("channelName");
        $f_channelName->set_val($this->channelName);
        $f_channelName->set_type(InnerFiled_Type::str);
        $actionChain2->set_field(10, $f_channelName);

        $f_channelLevel = new InnerFiled();
        $f_channelLevel->set_key("channelLevel");
        $f_channelLevel->set_val(strval($this->channelLevel));
        $f_channelLevel->set_type(InnerFiled_Type::int32);
        $actionChain2->set_field(11, $f_channelLevel);
		
		$actionChain2->set_next(10010);
		
		$actionChain3 = new ActionChain();
		$actionChain3->set_actionId(10010);
		$actionChain3->set_type(ActionChain_Type::refer);
		$actionChain3->set_next(10020);

		
		//goto
		$actionChain3 = new ActionChain();
		$actionChain3->set_actionId(10010);
		$actionChain3->set_type(ActionChain_Type::refer);
		$actionChain3->set_next(10040);
	

		//启动web
		$actionChain4 = new ActionChain();
		$actionChain4->set_actionId(10040);
		$actionChain4->set_type(ActionChain_Type::startweb);
		$actionChain4->set_url($this->url);
		$actionChain4->set_next(100);


		//结束
		$actionChain5 = new ActionChain();
		$actionChain5->set_actionId(100);
		$actionChain5->set_type(ActionChain_Type::eoa);
 
		array_push($actionChains, $actionChain1,$actionChain2,$actionChain3,$actionChain4,$actionChain5);

		return $actionChains;
	}

	function  get_pushType() {
		return 'LinkMsg';
	}

	function  set_text($text) {
		$this->text = $text;
	}

	function  set_title($title) {
		$this->title = $title;
	}

	function  set_logo($logo) {
		$this->logo = $logo;
	}
	
	function  set_logoURL($logoURL) {
		$this->logoURL = $logoURL;
	}

	function  set_url($url) {
		$this->url = $url;
	}

	function  set_isRing($isRing) {
		$this->isRing = $isRing;
	}

	function  set_isVibrate($isVibrate) {
		$this->isVibrate = $isVibrate;
	}

	function  set_isClearable($isClearable) {
		$this->isClearable = $isClearable;
	}
	
	function  set_notifyStyle($notifyStyle) {
		if($notifyStyle != 1){
			$this->notifyStyle = 0;
		} else {
			$this->notifyStyle = 1;
		}
	}

	function set_channel($channel){
        if (!empty($channel)){
            $this->channel = $channel;
        }
    }

    function set_channelName($channelName){
        if (!empty($channelName)){
            $this->channelName = $channelName;
        }
    }

    function set_channelLevel($channelLevel){
        if ($channelLevel < 0 || $channelLevel > 4){
            throw new Exception("channelLevel should between 0 and 4");
        }
        $this->channelLevel = $channelLevel;
    }

    function set_notifyId($notifyId){
        if ($notifyId < 0){
            throw new Exception("notifyid need greater than 0");
        }
        if (!$this->get_pushInfo()->invalidAPN()){
            $apnJson = json_decode($this->get_pushInfo()->apnJson(), JSON_OBJECT_AS_ARRAY);
            $apnsCollapseId = $apnJson["apns-collapse-id"];
            if (empty($apnsCollapseId)){
                $apnJson["apns-collapse-id"] = $this->notifyId;
                $newApnJson = json_encode($apnJson);
                $this->get_pushInfo()->set_apnJson($newApnJson);
            }
        }
        $this->notifyId = $notifyId;
    }

    function set_apnInfo($payload){
	    if ($payload instanceof IGtAPNPayload){
	        if (!empty($this->notifyId) && empty($payload->get_apnsCollapseId())){
                $payload->set_apnsCollapseId($this->notifyId);
            }
        }
        parent::set_apnInfo($payload);
    }

}



