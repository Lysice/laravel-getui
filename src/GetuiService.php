<?php

namespace Lysice\Getui;
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) . '/../getui/' . 'IGt.Push.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.AppMessage.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.TagMessage.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.APNPayload.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/template/IGt.BaseTemplate.php');
require_once(dirname(__FILE__) . '/../getui/' . 'IGt.Batch.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/utils/AppConditions.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/template/notify/IGt.Notify.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.MultiMedia.php');
require_once(dirname(__FILE__) . '/../getui/' . 'payload/VOIPPayload.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/template/IGt.RevokeTemplate.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/template/IGt.StartActivityTemplate.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.Target.php');
require_once(dirname(__FILE__) . '/../getui/' . 'exception/RequestException.php');
require_once(dirname(__FILE__) . '/../getui/' . 'igetui/IGt.AppMessage.php');

use IGeTui;
use IGtSingleMessage;
use Exception;
use Lysice\Getui\Traits\TemplateTrait;
use IGtTarget;
use Lysice\Getui\Traits\ValidateTrait;
use RequestException;
use IGtAppMessage;
use IGtListMessage;

/**
 * GetuiService
 */
class GetuiService
{
    use TemplateTrait, ValidateTrait;

    const HOST = 'http://sdk.open.api.igexin.com/apiex.htm';  //http的域名
    protected $instance = null;
    protected $gt_appid;
    protected $gt_appkey;
    protected $gt_appsecret;
    protected $gt_mastersecret;

    /**
     * GetuiService constructor.
     * @param array|null $configAll
     * @throws Exception
     */
    public function __construct(array $configAll = null)
    {
        if (empty($configAll)) {
            $configAll = include(__DIR__) . '/config/getui.php';
            if (empty($configAll)) {
                throw new Exception('请先配置推送后使用');
            }
        }

        $config = $configAll[$configAll['client_key']];

        $this->gt_appid = $config['appid'];
        $this->gt_appkey = $config['appkey'];
        $this->gt_appsecret = $config['appsecret'];
        $this->gt_mastersecret = $config['mastersecret'];
        $this->instance = new IGeTui(static::HOST, $this->gt_appkey, $this->gt_mastersecret);
    }

    /**
     * 推送模版
     * 推送效果设置分为通知样式设置和后续操作设置
     * 通知样式:响铃 震动 通知是否可清除
     * 后续操作:打开应用首页 打开应用内指定页面 打开浏览器指定网页
     * @param string $type
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    private function getTemplate(string $type = NULL, array $data = [])
    {
        return $this->getTemplateByType($type, $data);
    }

    /**
     * 进阶功能
     * 1.消息撤回
     * 2.消息覆盖
     * 3.短信补量 需要短信
     * 4.多厂商推送
     */

    /**
     * 统计API
     * 提供开发者获取推送数据接口 便于开发者整合到自己推送系统中
     * 1.推送结果查询
     * 2.用户统计数据查询
     * 3.用户画像数据查询
     */

    /**
     * 用户API
     * 个推 支持多种方式管理用户
     * 1.别名 开发者自定的的用户表示
     * 2.标签 用户特定属性
     * 3.黑名单 黑名单用户无法收到推送
     */

    /**
     * 推送API:
     * 1.toSingle 单推   向单个用户推送消息
     * 2.toList   批量推 向指定的用户推送消息
     * 3.toApp    群推   向APP符合筛选条件的所有用户推送消息 支持定速推送/定时推送/支持条件的交并补功能
     */

    /**
     * 单推
     * @param int $type
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function pushToSingle($type = 1, $data = [])
    {
        $fields = ['network_type', 'client_id'];
        $this->validateFields($fields, $data);

        // 1.选择通知模板
        $template = $this->getTemplate($type, $data);
        // 个推信息体
        $message = new IGtSingleMessage();
        $message->set_isOffline(true);//是否离线
        $time = isset($data['offline_expire_time']) ? $data['offline_expire_time'] : 3600 * 12 * 1000;
        $message->set_offlineExpireTime($time);//离线时间
        $message->set_data($template);//设置推送消息类型
        $message->set_PushNetWorkType($data['network_type']);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        //接收方
        $target = new IGtTarget();
        $target->set_appId($this->gt_appid);
        $target->set_clientId($data['client_id']);

        try {
            $response = $this->instance->pushMessageToSingle($message, $target);
            return $response;
        } catch (RequestException $e) {
            $requstId = $e->getRequestId();
            $response = $this->instance->pushMessageToSingle($message, $target, $requstId);
            return $response;
        }
    }

    /**
     * 批量推送
     * @param string $type
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function pushToList(string $type = NULL, array $data = [])
    {
        $fields = ['client_id_list', 'network_type'];
        $this->validateFields($fields, $data);

        $template = $this->getTemplate($type, $data);

        $message = new IGtListMessage();
        $message->set_data($template);
        $isOffLine = isset($data['is_offline']) ? $data['is_offline'] : true;
        $message->set_isOffline($isOffLine);
        $time = isset($data['offline_expire_time']) ? $data['offline_expire_time'] : 3600*12*1000;
        $message->set_offlineExpireTime($time);
        $message->set_pushNetWorkType($data['network_type']);

        // 1.获取taskId
        $contentId = $this->instance->getContentId($message);

        // 2.构建消息目标列表
        $targetList = [];
        foreach ($data['client_id_list'] as $clientId) {
            $target = new IGtTarget();
            $target->set_appId($this->gt_appid);
            $target->set_clientId($clientId);
            $targetList[] = $target;
        }

        // 3.批量推送
        $response = $this->instance->pushMessageToList($contentId, $targetList);
        return  $response;
    }

    /**
     * todo iOS
     * 批量单推
     */
    public function pushMessageToSingleBatch(array $data = [])
    {
        // 创建批次处理对象
        $batch = new \IGtBatch();
        $batch->setApiUrl(self::HOST);

        // 创建消息
    }

    /**
     * 推送给APP done
     * @param string $type
     * @param array $data
     * @return mixed|null
     * @throws Exception
     */
    public function pushToApp(string $type = NULL, array $data = [])
    {
        // 消息模板
        $template = $this->getTemplate($type, $data);

        // 定义"AppMessage"类型消息对象，设置消息内容模板、发送的目标App列表、是否支持离线发送、以及离线消息有效期(单位毫秒)
        $message = new IGtAppMessage();
        // 定速推送
        if (isset($data['speed'])) {
            $message->set_speed($data['speed']);
        }
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->set_data($template);

        $appIdList=array($this->gt_appid);
        $phoneTypeList=array('ANDROID');
        $provinceList=array('浙江');
        $tagList=array('haha');

        $message->set_appIdList($appIdList);

        //$message->set_conditions($cdt->getCondition());
        // STEP6：执行推送
        $response = $this->instance->pushMessageToApp($message,"task1");
        return $response;
    }

    /**
     * 获取消息的taskid
     * @param null $message
     * @return mixed
     */
    public function getTaskId($message = null)
    {
        return $this->instance->getContentId($message);
    }
}
