<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lysice\Getui\Facade\Getui;
use Lysice\Sms\Facade\SmsFacade;

class TestController extends Controller
{
    /**
     * 个推测试
     * @param Request $request
     */
    public function push(Request $request)
    {
        $this->transmission();
    }

    private function transmission()
    {
        // 1.单推
//        $this->transmissionSingle();
        // 2.多推
//        $this->transmissionList();
        // 3.全量推
//        $this->transmissionApp();
        // 4.自定义消息
        $this->transmissionCustom();
    }

    /**
     * 自定义消息-透传模板
     */
    private function transmissionCustom()
    {
        // 自定义数据
        $content = [
            'keyId' => 1,
            'keyType' => 111199
        ];
        $data = [
            'title' => '自定义消息iOS',
            'network_type' => 0,
            'transmission_type' => 2,
//            'client_id' => '249c93193d9a0734dcb62a7029b383cf',
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'content' => json_encode($content) // 自定义数据加密 接收端需要按照同样方式解密
        ];

        Getui::pushToSingle('transmission', $data);
        Getui::pushToApp('transmission', $data);
    }

    /**
     * 透传消息 单推
     */
    private function transmissionSingle()
    {
        $data = [
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'content' => '透传内容-单推1'
        ];
        Getui::pushToSingle('transmission', $data);
    }

    /**
     * 透传消息-全量
     */
    private function transmissionApp()
    {
        $data = [
            'transmission_type' => 2,
            'content' => '透传内容-全量6'
        ];
        $res = Getui::pushToApp('transmission', $data);
    }

    /**
     * 透传消息-多推
     */
    private function transmissionList()
    {
        $data = [
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42'
            ],
            'content' => '透传内容-多推1'
        ];
        Getui::pushToList('transmission', $data);
    }


    /**
     * 多推测试
     */
    private function pushtoList()
    {
        // 1.通知模板-打开应用首页
//        $this->notificationList();
        // 2.通知模板-打开连接
        $this->linkList();
    }

    /**
     * // 1.通知模板-打开应用首页
     */
    private function notificationList()
    {
        $data = [
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42',
            ],
            'network_type' => 0,
            'content' => '多推内容',
            'title' => '多推标题',
            'text' => '多推文本',
            'is_ring' => true,
            'is_vibrate' => true,
            'logo' => '',
            'logo_url' => ''
        ];

        Getui::pushToList('notification', $data);
    }

    /**
     * 2.通知模板-打开连接
     */
    private function linkList()
    {
        $data = [
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42',
            ],
            'network_type' => 0,
            'title' => '多推连接标题',
            'text' => '多推连接文本',
            'is_ring' => true,
            'is_vibrate' => true,
            'is_clearable' => true,
            'url' => 'https://www.baidu.com'
        ];

        Getui::pushToList('link', $data);
    }

    /**
     * 单推测试
     */
    private function pushtoSingle()
    {
        // 1.单推-打开链接
//        $this->linkSingle();
        // 2.单推-打开应用首页
        $this->notificationSingle();

    }

    /**
     * // 2.单推-打开应用首页
     */
    private function notificationSingle()
    {
        $data = [
            'network_type' => 0,
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'content' => '单人推送内容',
            'title' => '单人推送标题',
            'text' => '单人推送文本',
            'is_ring' => true,
            'is_vibrate' => true,
            'logo' => '',
            'logo_url' => ''
        ];

        Getui::pushToSingle('notification', $data);
    }

    /**
     * / 1.单推-打开链接
     */
    private function linkSingle()
    {
        $data = [
            'title' => '测试推送',
            'text' => '哈哈哈',
            'content' => '内容',
            'is_ring' => true,
            'is_vibrate' => true,
            'is_clearable' => true,
            'url' => 'http://www.juejin.im',
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'network_type' => 0
        ];

        Getui::pushToSingle('link', $data);
    }

    /**
     * 全量推送
     */
    private function pushtoapp()
    {
        // 全量推送-通知模板 打开连接
        $this->linkApp();
        $this->notificationApp();
    }


    /**
     * 全量推送-通知模板 打开连接
     */
    private function linkApp()
    {
        $data = [
            'title' => '网页推送',
            'text' => '网页推送文本',
            'is_ring' => true,
            'is_vibrate' => true,
            'url' => 'http://www.baidu.com',
            'is_clearable' => true
        ];

        Getui::pushToApp('link', $data);
    }

    /**
     * 全量推送-通知模板 打开首页
     */
    private function notificationApp()
    {
        $data = [
            'title' => '测试推送12111',
            'text' => '哈哈哈1',
            'content' => '内容511121322',
            'is_ring' => true,
            'is_vibrate' => true,
            'logo' => '',
            'logo_url' => 'http://wwww.igetui.com/logo.png'
        ];

        Getui::pushToApp('notification', $data);
    }
}
