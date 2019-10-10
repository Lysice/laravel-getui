<?php

/**
 * Class IGtNotify
 */
class IGtNotify {

    /**
     * 通知标题
     * @var
     */
    var $title;

    /**
     * 通知内容
     * @var
     */
    var $content;

    /**
     * 通知内容中携带的透传内容
     * @var
     */
    var $payload;

    /**
     * 通知内容带url
     */
    var $url;


    /**
     * 通知内容带intent
     */
    var $intent;

    /**
     * 指定通知中携带的类型
     */
    var $type;

    /**
     * 用于消息撤回
     */
    var $notifyId;

    //华为推送扩展
    var $extKVList = array();

    /**
     * @return mixed
     */
    public function get_title()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function get_content()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function set_content($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function get_payload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function set_payload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function get_url()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function set_url($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function get_intent()
    {
        return $this->intent;
    }

    /**
     * @param mixed $intent
     */
    public function set_intent($intent)
    {
        $this->intent = $intent;
    }

    /**
     * @return mixed
     */
    public function get_type()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function set_type($type)
    {
        $this->type = $type;
    }

    function set_notifyId($notifyId){
        if ($notifyId < 0){
            throw new Exception("notifyid need greater than 0");
        }
        $this->notifyId = $notifyId;
    }

    function get_notifyId(){
        return $this->notifyId;
    }

    function get_extKVList(){
        return $this->extKVList;
    }

    function addExtKVToAll($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::ALL);
        return $this;
    }

    function addHWExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::HW);
        return $this;
    }
    function addXMExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::XM);
        return $this;
    }
    function addMZExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::MZ);
        return $this;
    }
    function addOPExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::OP);
        return $this;
    }
    function addVVExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::VV);
        return $this;
    }

    function addFCMExtKV($key, $value){
        $this->extKVList[] = new NotifyExtKV($key, $value, PlatformConstains::FCM);
        return $this;
    }
}

class PlatformConstains
{
    const HW = 'HW';
    const XM = 'XM';
    const VV = 'VV';
    const MZ = 'MZ';
    const FCM = 'FCM';
    const OP = 'OP';
    const ALL = "ALL";
}

class NotifyExtKV{
    var $key;
    var $value;
    var $constrains = PlatformConstains::ALL;

    function __construct($key, $value, $constrains)
    {
        $this->key = $key;
        $this->value = json_encode($value);
        $this->constrains = $constrains;
    }

    function get_key(){
        return $this->key;
    }
    function get_value(){
        return $this->value;
    }
    function get_constrains(){
        return $this->constrains;
    }
    function set_key($key){
        $this->key = $key;
    }

}