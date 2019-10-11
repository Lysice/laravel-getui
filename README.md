# 欢迎使用 Laravel扩展包 laravel-getui

**网上有一款shaozeming/laravel-getui,自己在lumen下用，无奈报错依赖出问题，于是自己写了一款。**


# 主要功能

## 单人推送/多人推送/全量推送/推送任务撤回(待开发)

### 支持模板

#### 透传模板（自定义消息）

#### 通知模板（打开应用首页）

#### 通知模板 （打开浏览器网页）

#### 通知模板 （打开应用内页面）



### 安装

` composer require lysice/laravel-getui `


### 发布配置

`php artisan vendor:publish --provider="Lysice/Getui/GetuiServiceProvider"`

### 给 `config/app.php` 添加服务提供者
providers 数组中添加:

    `Lysice\Getui\GetuiServiceProvider::class`

### 使用
#### 1.单推
##### 1-1单推-通知打开应用首页
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
        // 第一个参数:
        Getui::pushToSingle('notification', $data);
    }
##### 1-2 单推-通知打开链接
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
		
##### 1-3 单推-透传模板
		$data = [
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'content' => '透传内容-单推1'
        ];
        Getui::pushToSingle('transmission', $data);

#### 2 多推
##### 2-1 多推-通知打开应用首页
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

##### 2-2 多推-通知模板-打开链接
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
		
##### 2-3 多推-透传消息
		$data = [
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42'
            ],
            'content' => '透传内容-多推'
        ];
        Getui::pushToList('transmission', $data);
		
#### 3 全量推送
##### 3-1 全量推送-通知模板-打开链接
		$data = [
            'title' => '网页推送',
            'text' => '网页推送文本',
            'is_ring' => true,
            'is_vibrate' => true,
            'url' => 'http://www.baidu.com',
            'is_clearable' => true
        ];

        Getui::pushToApp('link', $data);
		
##### 3-2 全量推送-通知模板-打开应用首页
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
		
##### 3-3 全量推送-透传-全量
		$data = [
            'transmission_type' => 2,
            'content' => '透传内容-全量6'
        ];
        $res = Getui::pushToApp('transmission', $data);
		
##### 3-4 全量推送-透传模板-多推
		$data = [
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42'
            ],
            'content' => '透传内容-多推1'
        ];
        Getui::pushToList('transmission', $data);
		
#### 4 自定义消息
##### 4-1 全量推送-自定义消息-透传模板

		// 自定义数据
        $content = [
            'keyId' => 1,
            'keyType' => 111199
        ];
		$data = [
            'title' => '自定义消息iOS',
            'transmission_type' => 2,
            'content' => json_encode($content) // 自定义数据加密 接收端需要按照同样方式解密
        ];
        
        Getui::pushToApp('transmission', $data);

##### 4-2 单推-自定义消息-透传模板
		// 自定义数据
        $content = [
            'keyId' => 1,
            'keyType' => 111199
        ];
        $data = [
            'title' => '自定义消息iOS',
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id' => 'c3024643a24c11bd3762d437c9103a42',
            'content' => json_encode($content) // 自定义数据加密 接收端需要按照同样方式解密
        ];
        Getui::pushToSingle('transmission', $data);
		
##### 4-3 多推-自定义消息-透传模板
		$data = [
            'title' => '自定义消息iOS',
            'network_type' => 0,
            'transmission_type' => 2,
            'client_id_list' => [
                'c3024643a24c11bd3762d437c9103a42'
            ],
            'content' => json_encode($content) // 自定义数据加密 接收端需要按照同样方式解密
        ];
        Getui::pushToList('transmission', $data);
		

### 后续功能待添加
#### 1 消息撤回
#### 2 通知消息模板下载
#### 3 实时设置配置信息等


