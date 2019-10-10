<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) . '/' . 'IGt.Push.php');
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.AppMessage.php');
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.TagMessage.php');
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.APNPayload.php');
require_once(dirname(__FILE__) . '/' . 'igetui/template/IGt.BaseTemplate.php');
require_once(dirname(__FILE__) . '/' . 'IGt.Batch.php');
require_once(dirname(__FILE__) . '/' . 'igetui/utils/AppConditions.php');
require_once(dirname(__FILE__) . '/' . 'igetui/template/notify/IGt.Notify.php');
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.MultiMedia.php');
require_once(dirname(__FILE__) . '/' . 'payload/VOIPPayload.php');
require_once ('igetui/template/IGt.RevokeTemplate.php');
require_once ('igetui/template/IGt.StartActivityTemplate.php');

////设置代理
//putenv("gexin_http_proxy_ip=ip");
//putenv("gexin_http_proxy_port=3128");
//putenv("gexin_http_proxy_username=getui");
//putenv("gexin_http_proxy_passwd=123456");

//现网demo
define('APPKEY','');
define('APPID','');
define('MASTERSECRET','');
define('CID','');
define('HOST',"http://sdk.open.api.igexin.com/apiex.htm");

//getUserStatus();

//stoptask();

//setTag();

//getUserTags();

//pushMessageToSingle();1

//pushMessageByTag();

//pushMessageToSingleBatch();

//getPersonaTagsDemo();

//getUserCountByTagsDemo();

//pushMessageToList();

//pushMessageToApp();
//
//getPushMessageResultDemo();
//getScheduleTaskDemo();
//getPushResultByGroupNameDemo();
//getUserCountByTagsDemo();
//getPushResultByGroupNameDemo();
//getLast24HoursOnlineUserStatisticsDemo();
//restoreCidListFromBlkDemo();
//addCidListToBlkDemo();
//setBadgeForCIDDemo();
//setBadgeForDeviceTokenDemo();
//
//pushTagMessageRetryDemo();
//
//getScheduleTaskDemo();
//delScheduleTaskDemo();
//bindCidPnDemo();
//unbindCidPnDemo();
//queryCidPnDemo();
//stopSendSmsDemo();

function getPersonaTagsDemo1() {
    $s = new IGtBaseTemplate();
    $s->setBlackThirdparty(Thirdparty::HW,Thirdparty::MZ);
}
//getPersonaTagsDemo1();
function getPersonaTagsDemo() {
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $ret = $igt->getPersonaTags(APPID);
    var_dump($ret);
}
function getUserCountByTagsDemo() {
	$igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $tagList = array("金在中","龙卷风");
	$ret = $igt->getUserCountByTags(APPID, $tagList);
	var_dump($ret);
}

function getScheduleTaskDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $ret = $igt->getScheduleTask(TASKID,APPID);
    var_dump($ret);
}
function delScheduleTaskDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $ret = $igt->delScheduleTask(TASKID,APPID);
    var_dump($ret);
}
function getPushResultByGroupNameDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $ret = $igt->getPushResultByGroupName(APPID,"11");
    json_encode($ret);
}
//getLast24HoursOnlineUserStatisticsDemo();
function getLast24HoursOnlineUserStatisticsDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $ret = $igt->getLast24HoursOnlineUserStatistics("appid");
    var_dump($ret);
}
function restoreCidListFromBlkDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cidList=array("cid","");
    $ret = $igt->restoreCidListFromBlk(APPID,$cidList);
    var_dump($ret);
}
function addCidListToBlkDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cidList=array("cid","");
    $ret = $igt->addCidListToBlk(APPID,$cidList);
    var_dump($ret);
}
function setBadgeForCIDDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cidList=array("cid","");
    $ret = $igt->setBadgeForCID(Badge,APPID,$cidList);
    var_dump($ret);
}
function setBadgeForDeviceTokenDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cidList=array("cid","");
    $ret = $igt->setBadgeForDeviceToken(Badge,APPID,$cidList);
    var_dump($ret);
}
function pushTagMessageRetryDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $template = IGtLinkTemplateDemo();
    //个推信息体
    //基于应用消息体
    $message = new IGtTagMessage();
    $message->set_isOffline(true);
    $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
    $message->set_data($template);

    $appIdList=array(APPID);

    $message->set_tag("123");
    $message->set_appIdList($appIdList);
    $ret = $igt->pushTagMessageRetry($message);
    var_dump($ret);
}
//bindCidPnDemo();
function bindCidPnDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $params = array();
    $params[CID] = md5(PN);
    $params["cid"] = PN;
    $ret = $igt->bindCidPn(appId,$params);
    var_dump($ret);
}
//unbindCidPnDemo();
function unbindCidPnDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cids=array("cid","");
    $ret = $igt->unbindCidPn(APPID,$cids);
    var_dump($ret);
}
function queryCidPnDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $cidList=array(CID);
    $ret = $igt->queryCidPn(APPID,$cidList);
    var_dump($ret);
}
function stopSendSmsDemo(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $ret = $igt->stopSendSms(APPID,TASKID);
    var_dump($ret);
}

function getPushMessageResultDemo(){

//    putenv("gexin_default_domainurl=http://183.129.161.174:8006/apiex.htm");

    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);

//    $ret = $igt->getPushResult("OSA-0522_QZ7nHpBlxF6vrxGaLb1FA3");
//    var_dump($ret);

//    $ret = $igt->queryAppUserDataByDate(APPID,"20140807");
//    var_dump($ret);

    $ret = $igt->queryAppPushDataByDate(APPID,"20190807");
    var_dump($ret);
}

//用户状态查询
//getUserStatus();
function getUserStatus() {
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $rep = $igt->getClientIdStatus(APPID,CID);
    var_dump($rep);
    echo ("<br><br>");
}

//推送任务停止
function stoptask(){

    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $igt->stop("taskid");
}

//通过服务端设置ClientId的标签
function setTag(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $tagList = array('','中文','English');
    $rep = $igt->setClientTag(APPID,CID,$tagList);
    var_dump($rep);
    echo ("<br><br>");
}

function getUserTags() {
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $rep = $igt->getUserTags(APPID,CID);
    //$rep.connect();
    var_dump($rep);
    echo ("<br><br>");
}

//try {
//    pushMessageToSingleToSMS();
//} catch (Exception $e) {
//    echo 1222;
//    echo $e->getMessage();
//}
//setSmsInfo接口
//pushMessageToSingleToSMS();
function pushMessageToSingleToSMS(){

    try {
        $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
        $template = new IGtTransmissionTemplate();
        $template->set_appId(APPID);
        $template->set_appkey(APPKEY);
        $template->set_transmissionType(2);
        $template->set_transmissionContent("123123");
        $template->setBlackThirdparty(Thirdparty::FCM,Thirdparty::XM);
        $notify = new IGtNotify();
        $notify->set_title("title");
        $notify->set_content("content");
        $notify->set_notifyId(123456789);
        $notify->set_type(NotifyInfo_Type::_intent);
        $notify->set_url("http://www.baidu.com");
        $notify->set_payload("通知内容中携带的透传内容");
        //设置华为角标
        $notify->addHWExtKV("badgeAddNum","\"1\"");
        $notify->addHWExtKV("badgeClass","\"activity\"");
        //设置华为图标
        $notify->addHWExtKV("icon","http://www.baidu.com");
        $notify->set_intent("intent:#Intent;action=com.demo.getui;component=com.demo.getui/activity;S.key1=value1;end");
//        $notify->set_intent("intent:#Intent;package=com.pp.yl;component=com.pp.yl/com.getui.demo.MainActivity;i.parm1=12;f.parm2=13.5;b.parm3=3;l.parm4=12345678954;s.parm5=10;S.parm6=string%20%E7%B1%BB%E5%9E%8B;S.parm7=body%20%3C%20%3E%20%3D%20*%20%3F%20!%20%23;B.parm8=true;d.parm9=13.501256;with;end");
        $template->set3rdNotifyInfo($notify);
        $smsMessage = new SmsMessage();//    $smsContent = array();
        //    $smsContent["url"] = "http://www.baidu.com/getui";
        $smsMessage->setPayload("1234");
        $smsMessage->setUrl("http://www/getui");
        $smsMessage->setSmsTemplateId("a278f716b5fe4434b4f3bf4e46ca9d36");
        $smsMessage->setOfflineSendtime(1000);
        $smsMessage->setIsApplink(true);//    $smsMessage->smsContent($smsContent);
        $template->setSmsInfo($smsMessage);
        $message = new IGtSingleMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(60 * 60 * 1000);
        $message->set_data($template);
        $target = new IGtTarget();
        $target->set_appId(APPID);
        $target->set_clientId(CID);
        echo 2;
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        echo $e->getMessage();
    }
    try {
        for ($i = 0; $i < 1; $i++) {
            $ret = $igt->pushMessageToSingle($message, $target, "121231233123");
            var_dump($ret);
        }
    }catch (RequestException $e){
            $requstId = $e->getRequestId();
            $ret = $igt->pushMessageToSingle($message,$target,$requstId);
            var_dump($ret);
    }
 }
//服务端推送接口，支持三个接口推送
//1.PushMessageToSingle接口：支持对单个用户进行推送
//2.PushMessageToList接口：支持对多个用户进行推送，建议为50个用户
//3.pushMessageToApp接口：对单个应用下的所有用户进行推送，可根据省份，标签，机型过滤推送
//
//单推接口案例
function pushMessageToSingle(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);

    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板

//    	$template = IGtNotyPopLoadTemplateDemo();
//    	$template = IGtLinkTemplateDemo();
    	$template = IGtNotificationTemplateDemo();
//    $template = IGtTransmissionTemplateDemo();
//    $template = IGtTransmissionVOIPTemplateDemo();
//    $template = SmsDemo();
    //个推信息体
    $message = new IGtSingleMessage();

    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600*12*1000);//离线时间
    $message->set_data($template);//设置推送消息类型
//	$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
    //接收方
    $target = new IGtTarget();
    $target->set_appId(APPID);
    $target->set_clientId(CID);
//    $target->set_alias(Alias);


    try {
        $rep = $igt->pushMessageToSingle($message, $target);
        var_dump($rep);
        echo ("<br><br>");

    }catch(RequestException $e){
        $requstId =$e->getRequestId();
        $rep = $igt->pushMessageToSingle($message, $target,$requstId);
        var_dump($rep);
        echo ("<br><br>");
    }

}


function pushMessageToSingleBatch()
{
    putenv("gexin_pushSingleBatch_needAsync=false");

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    $batch = new IGtBatch(APPKEY, $igt);
    $batch->setApiUrl(HOST);
    //$igt->connect();
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板

    //$template = IGtNotyPopLoadTemplateDemo();
    $templateLink = IGtLinkTemplateDemo();
    $templateNoti = IGtNotificationTemplateDemo();
    //$template = IGtTransmissionTemplateDemo();

    //个推信息体
    $messageLink = new IGtSingleMessage();
    $messageLink->set_isOffline(true);//是否离线
    $messageLink->set_offlineExpireTime(12 * 1000 * 3600);//离线时间
    $messageLink->set_data($templateLink);//设置推送消息类型
    //$messageLink->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

    $targetLink = new IGtTarget();
    $targetLink->set_appId(APPID);
    $targetLink->set_clientId(CID1);
    $batch->add($messageLink, $targetLink);

    //个推信息体
    $messageNoti = new IGtSingleMessage();
    $messageNoti->set_isOffline(true);//是否离线
    $messageNoti->set_offlineExpireTime(12 * 1000 * 3600);//离线时间
    $messageNoti->set_data($templateNoti);//设置推送消息类型
    //$messageNoti->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

    $targetNoti = new IGtTarget();
    $targetNoti->set_appId(APPID);
    $targetNoti->set_clientId(CID2);
    $batch->add($messageNoti, $targetNoti);
    try {

        $rep = $batch->submit();
        var_dump($rep);
        echo("<br><br>");
    }catch(Exception $e){
        $rep=$batch->retry();
        var_dump($rep);
        echo ("<br><br>");
    }
}

//pushMessageToList();
//多推接口案例
function pushMessageToList()
{
    putenv("gexin_pushList_needDetails=true");
    putenv("gexin_pushList_needAsync=true");

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板


    //$template = IGtNotyPopLoadTemplateDemo();
    //$template = IGtLinkTemplateDemo();
    //$template = IGtNotificationTemplateDemo();
    $template = IGtTransmissionTemplateDemo();
    //个推信息体
    $message = new IGtListMessage();
    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
    $message->set_data($template);//设置推送消息类型
//    $message->set_PushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//    $contentId = $igt->getContentId($message);
    $contentId = $igt->getContentId($message,"toList任务别名功能");	//根据TaskId设置组名，支持下划线，中文，英文，数字

    //接收方1
    $target1 = new IGtTarget();
    $target1->set_appId(APPID);
    $target1->set_clientId(CID);
//    $target1->set_alias(Alias);

    $targetList[] = $target1;

    $rep = $igt->pushMessageToList($contentId, $targetList);

    var_dump($rep);

    echo ("<br><br>");

}

//群推接口案例
function pushMessageToApp(){

    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);

//    $template = IGtLinkTemplateDemo();
    $template = IGtNotificationTemplateDemo();
    //个推信息体
    //基于应用消息体
    $message = new IGtAppMessage();
    $message->set_isOffline(true);
    $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
    $message->set_data($template);
    $appIdList=array(APPID);
    $phoneTypeList=array('ANDROID');
    $provinceList=array('浙江');
    $tagList=array('haha');
    $age = array("0000", "0010");
//
//
    $cdt = new AppConditions();
    $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
    $cdt->addCondition(AppConditions::REGION, $provinceList);
    $cdt->addCondition(AppConditions::TAG, $tagList);
    $cdt->addCondition("age", $age);

    $message->set_appIdList($appIdList);
//    $message->set_conditions($cdt);
    $rep = $igt->pushMessageToApp($message);

    var_dump($rep);
    echo ("<br><br>");
}

//所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
//注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能

function IGtNotyPopLoadTemplateDemo(){
    $template =  new IGtNotyPopLoadTemplate();

    $template->set_notifyId(12345678);
    $template ->set_appId(APPID);//应用appid
    $template ->set_appkey(APPKEY);//应用appkey
    //通知栏
    $template ->set_notyTitle("个推");//通知栏标题
    $template ->set_notyContent("个推最新版点击下载");//通知栏内容
    $template ->set_notyIcon("");//通知栏logo
    $template ->set_isBelled(true);//是否响铃
    $template ->set_isVibrationed(true);//是否震动
    $template ->set_isCleared(true);//通知栏是否可清除
    //弹框
    $template ->set_popTitle("弹框标题");//弹框标题
    $template ->set_popContent("弹框内容");//弹框内容
    $template ->set_popImage("");//弹框图片
    $template ->set_popButton1("下载");//左键
    $template ->set_popButton2("取消");//右键
    //下载
    $template ->set_loadIcon("");//弹框图片
    $template ->set_loadTitle("地震速报下载");
    $template ->set_loadUrl("http://url");
    $template ->set_isAutoInstall(false);
    $template ->set_isActived(true);
    $template->set_channel("set_channel");
    $template->set_channelName("set_channelName");
    $template->set_channelLevel(3);
	//$template->set_notifyStyle(0);
    //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

    return $template;
}

function IGtLinkTemplateDemo(){
    $template =  new IGtLinkTemplate();
    $template ->set_appId(APPID);//应用appid
    $template ->set_appkey(APPKEY);//应用appkey
    $template ->set_title("请输入通知标题");//通知栏标题
    $template ->set_text("请输入通知内容");//通知栏内容
    $template ->set_logo("");//通知栏logo
    $template ->set_isRing(true);//是否响铃
    $template ->set_isVibrate(true);//是否震动
    $template ->set_isClearable(true);//通知栏是否可清除
    $template ->set_url("http://www.igetui.com/");//打开连接地址
    $template->set_channel("set_channel");
    $template->set_channelName("set_channelName");
    $template->set_channelLevel(3);
//    $template->set_notifyId(123456789);
    //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    return $template;
}

function IGtNotificationTemplateDemo(){
    $template =  new IGtNotificationTemplate();
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_transmissionType(1);//透传消息类型
    $template->set_transmissionContent("测试离线");//透传内容
    $template->set_title("请输入通知栏\p{1f631}\p");//通知栏标题
    $template->set_text("请输入通知");//通知栏内容
//    $template->set_logo("http://wwww.igetui.com/logo.png");//通知栏logo
//    $template->set_isRing(true);//是否响铃
//    $template->set_isVibrate(true);//是否震动
    $template->set_isClearable(true);//通知栏是否可清除
//    $template->set_notifyId(123456789);
//    $template->set_channel("set_channel");
//    $template->set_channelName("set_channelName");
//    $template->set_channelLevel(3);
    //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    return $template;
}

//try {
//    IGtTransmissionTemplateDemo();
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
function IGtTransmissionTemplateDemo(){
    $template =  new IGtTransmissionTemplate();
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_transmissionType(1);//透传消息类型
    $template->set_transmissionContent("测试离线ddd");//透传内容
//    $template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
    //APN简单推送
//        $template = new IGtAPNTemplate();
        $apn = new IGtAPNPayload();
        $alertmsg=new SimpleAlertMsg();
        $alertmsg->alertMsg="";
        $apn->alertMsg=$alertmsg;
        $apn->badge=2;
        $apn->sound="";
        $apn->add_customMsg("payload","payload");
        $apn->contentAvailable=1;
        $apn->category="ACTIONABLE";
//        $template->set_apnInfo($apn);
//        $message = new IGtSingleMessage();

    //第三方厂商推送透传消息带通知处理

    $notify = new IGtNotify();
    $notify -> set_payload("{}");
    $notify -> set_title("透传通知标题");
    $notify -> set_content("透传通知内容");
    $notify->set_type(NotifyInfo_Type::_payload);
//    $message1 = new cTest();
//    $message1->set_a("aaaaa");
//
//    $notify->addXMExtKV("mzy-xm-k",$message1);
//		$notify->addHWExtKV("mzy-hw-k",$message1);
//		$notify->addFCMExtKV("mzy-fcm-k",$message1);
//		$notify->addOPExtKV("mzy-op-k",$message1);
    $template -> set3rdNotifyInfo($notify);

    //APN高级推送
    $apn = new IGtAPNPayload();
    $alertmsg=new DictionaryAlertMsg();
    $alertmsg->body="body";
    $alertmsg->actionLocKey="ActionLockey";
    $alertmsg->locKey="LocKey";
    $alertmsg->locArgs=array("locargs");
    $alertmsg->launchImage="launchimage";
//        IOS8.2 支持
    $alertmsg->title="Title";
    $alertmsg->titleLocKey="TitleLocKey";
    $alertmsg->titleLocArgs=array("TitleLocArg");

    $alertmsg->subtitle = "subtitle";

    $apn->alertMsg=$alertmsg;
    $apn->badge=7;
    $apn->sound="";
    $apn->add_customMsg("payload","payload");
    $apn->voicePlayType = 1;
    $apn->contentAvailable=1;
    $apn->category="ACTIONABLE";
    //IOS多媒体消息处理
    $media = new IGtMultiMedia();
    $media -> set_url("http://url");
    $media -> set_onlywifi(false);
    $media -> set_type(MediaType::pic);

    $medias = array();
    $medias[] = $media;
    //$apn->set_multiMedias($medias);

//    $template->set_pushInfo();
    $template->set_apnInfo($apn);

    //PushApn老方式传参
//    $template = new IGtAPNTemplate();
//          $template->set_pushInfo("", 10, "", "com.gexin.ios.silence", "", "", "", "");
    return $template;
}

//多标签推送接口案例
function pushMessageByTag(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
    $template = IGtLinkTemplateDemo();
    //个推信息体
    //基于应用消息体
    $message = new IGtTagMessage();
    $message->set_isOffline(true);
    $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
    $message->set_data($template);

    $appIdList=array(APPID);

    $message->set_tag("123");
    $message->set_appIdList($appIdList);

    $rep = $igt->pushTagMessage($message);

    var_dump($rep);
    echo ("<br><br>");
}

// 透传消息模板
function IGtTransmissionTemplateFunction(){
    $template =  new IGtTransmissionTemplate();
    $template->set_appId('appid');//应用appid
    $template->set_appkey('appkey');//应用appkey
    $template->set_transmissionType(1);//透传消息类型
    $template->set_transmissionContent('12345677');//透传内容

    return $template;
}
// 打开应用内页面
function IGtStartActivityTemplateDemo(){

    try {
        $template = new IGtStartActivityTemplate();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo 21;
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_intent("");
    $template->set_title("个推");//通知栏标题
    $template->set_text("个推最新版点击下载");//通知栏内容
    $template->set_logo("");//通知栏logo
    $template->set_logoURL("http://*");
    $template->set_isRing(true);//是否响铃
    $template->set_isVibrate(true);//是否震动
    $template->set_isClearable(true);//通知栏是否可清除
    $template->set_duration("2019-10-14 08:00:00","2019-10-14 09:00:00");
    $smsMessage = new SmsMessage();//设置短信通知
    $smsMessage->setPayload("1234");
    $smsMessage->setUrl("http://www/getui");
    $smsMessage->setSmsTemplateId("123456789");
    $smsMessage->setOfflineSendtime(1000);
    $smsMessage->setIsApplink(true);
    $template->setSmsInfo($smsMessage);
    $template->set_notifyId(123456543);
    return $template;
}
// 撤回
function getRevokeTemplateDemo(){
    $revoke = new IGtRevokeTemplate();
    $revoke->set_appId("appid");
    $revoke->set_appkey("appkey");
    $revoke->set_oldTaskId("taskId");
    $revoke->set_force(false);
    return $revoke;
}

try {
    try {

        $igt = new IGeTui(null, APPKEY, MASTERSECRET);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    for ($i = 0; $i < 1; $i++) {
        echo "------------------fasturl = ". $igt->host."\n";
        pushMessageToSingleForTemplate($igt);
        sleep(3);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
//setSmsInfo接口
function pushMessageToSingleForTemplate($igt){

//        $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
//        $template =  IGtNotyPopLoadTemplateDemo();
        $template =  IGtNotificationTemplateDemo();
//        $template =  IGtLinkTemplateDemo();
//    $template = IGtStartActivityTemplateDemo();
//    $template=IGtTransmissionTemplateDemo();
//    echo 'begin';

        //APN简单推送
//        $apn = new IGtAPNPayload();
//        $alertmsg=new DictionaryAlertMsg();
//        $alertmsg->title = "title";
//        $alertmsg->set_summaryArg("set_summaryArg");
//        $alertmsg->set_summaryArgCount(4);

//        $apn->alertMsg=$alertmsg;
//        $apn->badge=2;
//        $apn->sound="";
//        $apn->add_customMsg("payload","payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
//        $apn->set_threadId("set_threadId");
        $sound_d = new Sound();
    $sound_d->set_name("set_name");
    $sound_d->set_critical(1);
//    $sound_d->set_volume(0.5);
//        $apn->set_sound_d($sound_d);
//        $template->set_apnInfo($apn);
    echo 'begin';

        $message = new IGtSingleMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(60 * 60 * 1000);
        $message->set_data($template);
        $message->set_pushNetWorkType(0);
        $target = new IGtTarget();
        $target->set_appId(APPID);
        $target->set_clientId(CID);
    try {
        for ($i = 0; $i < 1; $i++) {
            echo 'begin';
            $ret = $igt->pushMessageToSingle($message, $target, "121231233123");
            var_dump($ret);
        }
    }catch (Exception $e){
        echo $e->getMessage();
//        $requstId = $e->getRequestId();
//        $ret = $igt->pushMessageToSingle($message,$target,$requstId);
//        var_dump($ret);
    }
}
?>

