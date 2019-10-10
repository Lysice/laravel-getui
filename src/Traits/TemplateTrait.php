<?php
namespace Lysice\Getui\Traits;

require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.RevokeTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.StartActivityTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.LinkTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.NotificationTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.TransmissionTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/IGt.NotyPopLoadTemplate.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/template/notify/IGt.Notify.php');
require_once(dirname(__FILE__) . '/../../getui/' . 'igetui/IGt.APNPayload.php');

use Lysice\Getui\Constants\TemplateConstants;
use IGtRevokeTemplate;
use IGtStartActivityTemplate;
use SmsMessage;
use IGtLinkTemplate;
use IGtNotificationTemplate;
use IGtTransmissionTemplate;
use IGtNotyPopLoadTemplate;
use IGtAPNPayload;

trait TemplateTrait
{
    /**
     * 根据传入类型获取消息模板
     * @param string $type
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    private function getTemplateByType(string $type = '', array $params = [])
    {
        if (key_exists($type, TemplateConstants::TEMPLATE_TYPES)) {
            $method = TemplateConstants::TEMPLATE_TYPES[$type];
            return $this->$method($params);
        }

        throw new \Exception('消息模板不存在!');
    }

    /**
     * 【通知模板】通知弹框下载功能模板
     * @param array $data
     * @return IGtNotyPopLoadTemplate
     * @throws \Exception
     */
    private function getNotyPopLoadTemplate(array $data = [])
    {
        $template =  new IGtNotyPopLoadTemplate();

        $template->set_notifyId($data['notify_id']);
        $template ->set_appId($this->gt_appid);//应用appid
        $template ->set_appkey($this->gt_appkey);//应用appkey
        //通知栏
        $template ->set_notyTitle($data['notify_title']);//通知栏标题
        $template ->set_notyContent($data['notify_content']);//通知栏内容
        $template ->set_notyIcon($data['notify_icon']);//通知栏logo
        $template ->set_isBelled($data['is_belled']);//是否响铃
        $template ->set_isVibrationed($data['is_vibrationed']);//是否震动
        $template ->set_isCleared($data['is_cleared']);//通知栏是否可清除
        //弹框
        $template ->set_popTitle($data['pop_title']);//弹框标题
        $template ->set_popContent($data['pop_content']);//弹框内容
        $template ->set_popImage($data['pop_image']);//弹框图片
        $template ->set_popButton1($data['pop_button_left']);//左键
        $template ->set_popButton2($data['pop_buton_right']);//右键
        //下载
        $template ->set_loadIcon($data['load_icon']);//弹框图片
        $template ->set_loadTitle($data['load_title']);
        $template ->set_loadUrl($data['load_url']);
        $template ->set_isAutoInstall($data['is_auto_install']);
        $template ->set_isActived($data['is_actived']);
        $template->set_channel($data['channel']);
        $template->set_channelName($data['channel_name']);
        $template->set_channelLevel($data['channel_level']);
        //$template->set_notifyStyle(0);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        return $template;
    }

    /**
     * 【透传模板】自定义消息
     * @param array $data
     * @return IGtTransmissionTemplate
     * @throws \Exception
     */
    private function getTransmissionTemplate(array $data = [])
    {
        $fields = ['transmission_type', 'content', 'title'];
        $this->validateFields($fields, $data);
        $template = new IGtTransmissionTemplate();
        //应用appid
        $template->set_appId($this->gt_appid);
        //应用appkey
        $template->set_appkey($this->gt_appkey);
        //透传消息类型
        $template->set_transmissionType($data['transmission_type']);
        //透传内容
        $template->set_transmissionContent($data['content']);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        // iOS推送必要设置
        $transContent = $data['content'];
        if (isset($data['function'])) {
            $method = $data['function'];
            if (function_exists($method)) {
                $transContent = $method($data['content']);
            } else {
                throw new \Exception('自定义消息加密函数' . $method . '不存在!');
            }
        }

        $apn = $this->setIOSPushInfo($data['content'], $data['title'], $transContent);
        $template->set_apnInfo($apn);

        return $template;
    }

    /**
     * 【通知模板】 打开应用首页
     * @param array $data
     * @return IGtNotificationTemplate
     * @throws \Exception
     */
    private function getNotificationTemplate(array $data = [])
    {
        $fields = ['content', 'title', 'text', 'is_ring', 'is_vibrate', 'logo', 'logo_url'];
        $this->validateFields($fields, $data);

        $template =  new IGtNotificationTemplate();
        $template->set_appId($this->gt_appid);            //应用appid
        $template->set_appkey($this->gt_appkey);          //应用appkey
        $template->set_transmissionType(1);//透传消息类型
        $template->set_transmissionContent($data['content']);//透传内容
        $template->set_title($data['title']);            //通知栏标题
        $template->set_text($data['text']);              //通知栏内容
        $template->set_logo($data['logo']);            //通知栏logo
        $template->set_logoURL($data['logo_url']); //通知栏logo链接
        $template->set_isRing($data['is_ring']);         //是否响铃
        $template->set_isVibrate($data['is_vibrate']);   //是否震动
        $template->set_isClearable(true);       //通知栏是否可清除
        //$template->set_duration(BEGINTIME,ENDTIME);    //设置ANDROID客户端在此时间区间内展示消息
//        $template->set_channel($data['channel']);
//        $template->set_channelName($data['channel_name']);
//        $template->set_channelLevel($data['channel_level']);
//        $template->set_notifyId($data['notify_id']);
        return $template;
    }

    /**
     * 【通知模板】 打开浏览器网页
     * @param array $data
     * @return IGtLinkTemplate
     * @throws \Exception
     */
    private function getLinkTemplate(array $data = [])
    {
        $fields = ['title', 'text', 'is_ring', 'is_vibrate', 'is_clearable', 'url'];
        $this->validateFields($fields, $data);
        $template = new IGtLinkTemplate();
        $template->set_appId($this->gt_appid);                  //应用appid
        $template->set_appkey($this->gt_appkey);                //应用appkey
        $template->set_title($data['title']);       //通知栏标题
        $template->set_text($data['text']);        //通知栏内容
        $template->set_logo("");                       //通知栏logo
        $template->set_logoURL("");                    //通知栏logo链接
        $template->set_isRing($data['is_ring']);                  //是否响铃
        $template->set_isVibrate($data['is_vibrate']);               //是否震动
        $template->set_isClearable($data['is_clearable']);             //通知栏是否可清除
        $template->set_url($data['url']); //打开连接地址
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        $template->set_channel('set_channel');
        $template->set_channelName('channel_name');
        $template->set_channelLevel(3);
        $template->set_notifyId(12345678);

        return $template;
    }

    /**
     * iOS推送必要设置
     * @param string $content
     * @param string $title
     * @param string $transContent
     * @return IGtAPNPayload
     */
    private function setIOSPushInfo($content = '', $title = '', $transContent = '')
    {
        //APN高级推送
        $apn = new \IGtAPNPayload();
        $alertmsg = new \DictionaryAlertMsg();
        $alertmsg->body = $content;
        $alertmsg->actionLocKey = "ActionLockey";
        $alertmsg->locKey = "LocKey";
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
        // IOS8.2 支持
        $alertmsg->title = $title;
        $alertmsg->titleLocKey = "TitleLocKey";
        $alertmsg->titleLocArgs = array("TitleLocArg");

        $apn->alertMsg = $alertmsg;
        $apn->badge = 1;
        $apn->sound = "";

        $apn->add_customMsg("payload", $transContent);
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        return $apn;
    }

    /**
     * 【通知模板】 打开应用内页面
     * @param array $data
     * @return IGtStartActivityTemplate
     * @throws \Exception
     */
    private function getStartActivityTemplate(array $data = [])
    {
        $template = new IGtStartActivityTemplate();
        $template->set_appId($data['appid']);//应用appid
        $template->set_appkey($data['appkey']);//应用appkey
        $template->set_intent($data['indent']);
        $template->set_title($data['title']);//通知栏标题
        $template->set_text($data['text']);//通知栏内容
        $template->set_logo($data['logo']);//通知栏logo
        $template->set_logoURL($data['logo_url']);
        $template->set_isRing($data['is_ring']);//是否响铃
        $template->set_isVibrate($data['is_vibrate']);//是否震动
        $template->set_isClearable($data['is_clearable']);//通知栏是否可清除
        $template->set_duration($data['start'],$data['end']);
        $smsMessage = new SmsMessage();//设置短信通知
        $smsMessage->setPayload("1234");
        $smsMessage->setUrl("http://www/getui");
        $smsMessage->setSmsTemplateId($data['sms_template_id']);
        $smsMessage->setOfflineSendtime(1000);
        $smsMessage->setIsApplink(true);
        $template->setSmsInfo($smsMessage);
        $template->set_notifyId($data['notify_id']);
        return $template;
    }

    /**
     * 【通知模板】通知消息撤回
     * @param array $data 传入数据
     * @return IGtRevokeTemplate
     */
    private function getRevokeTemplate(array $data = [])
    {
        $revoke = new IGtRevokeTemplate();
        $revoke->set_appId($data['appid']);
        $revoke->set_appkey($data['appkey']);
        $revoke->set_oldTaskId($data['taskId']);
        $revoke->set_force(false);
        return $revoke;
    }
}
