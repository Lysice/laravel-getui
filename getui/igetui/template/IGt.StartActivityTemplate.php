 <?php

/**
 * Created by PhpStorm.
 * User: zqzhao5
 * Date: 17-9-26
 * Time: 下午5:55
 */
class IGtStartActivityTemplate extends IGtBaseTemplate
{
    var $intent;
    const pattern = '/^intent:#Intent;.*;end$/';
    var $text;
    var $title;
    var $logo;
    var $logoURL;
    var $notifyStyle;
    var $isRing;
    var $isVibrate;
    var $isClearable;
    /**
     * 用于消息覆盖
     */
    var $notifyId;

    public function  getActionChain() {
        $actionChains = array();
        //设置actionchain
        $actionChain1 = new ActionChain();
        $actionChain1->set_actionId(1);
        $actionChain1->set_type(ActionChain_Type::refer);
        $actionChain1->set_next(10000);

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

        $actionChain2->set_next(10010);

        $actionChain3 = new ActionChain();
        $actionChain3->set_actionId(10010);
        $actionChain3->set_type(ActionChain_Type::refer);
        $actionChain3->set_next(11220);

        $actionChain4 = new ActionChain();
        $actionChain4->set_actionId(11220);
        $actionChain4->set_type(ActionChain_Type::mmsinbox2);
        $actionChain4->set_stype("startmyactivity");

        $f_uri = new InnerFiled();
        $f_uri->set_key("uri");
        $f_uri->set_val($this->get_intent());
        $f_uri->set_type(InnerFiled_Type::str);
        $actionChain4->set_field(0,$f_uri);

        $f_doFailed = new InnerFiled();
        $f_doFailed->set_key("do_failed");
        $f_doFailed->set_val("100");
        $f_doFailed->set_type(InnerFiled_Type::str);
        $actionChain4->set_field(1,$f_doFailed);

        $actionChain4->set_next(100);

        $actionChain5 = new ActionChain();
        $actionChain5->set_actionId(100);
        $actionChain5->set_type(ActionChain_Type::eoa);

        array_push($actionChains, $actionChain1,$actionChain2,$actionChain3,$actionChain4,$actionChain5);

        return $actionChains;
    }

    function  get_pushType() {
        return 'StartActivity';
    }

    function set_intent($intent){
        if(strlen($intent) > GTConfig::getStartActivityIntentLimit()){
            throw new Exception("intent size overlimit " . GTConfig::getStartActivityIntentLimit());
        }
        //不符合intent的格式要求
        if(!preg_match(self::pattern,$intent)){
           throw new Exception("intent format err,should start with \"intent:#Intent;\",end \"with ;end\"  ");
        }

        $this -> intent = $intent;

    }

    function get_intent(){
        return $this->intent==null?"":$this->intent;
    }

    /**
     * @param mixed $text
     */
    public function set_text($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $title
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $logo
     */
    public function set_logo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param mixed $logoURL
     */
    public function set_logoURL($logoURL)
    {
        $this->logoURL = $logoURL;
    }

    /**
     * @param mixed $notifyStyle
     */
    public function set_notifyStyle($notifyStyle)
    {
        $this->notifyStyle = $notifyStyle;
    }

    /**
     * @param mixed $isRing
     */
    public function set_isRing($isRing)
    {
        $this->isRing = $isRing;
    }

    /**
     * @param mixed $isVibrate
     */
    public function set_isVibrate($isVibrate)
    {
        $this->isVibrate = $isVibrate;
    }

    /**
     * @param mixed $isClearable
     */
    public function set_isClearable($isClearable)
    {
        $this->isClearable = $isClearable;
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