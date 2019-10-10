<?php

namespace Lysice\Getui;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
/**
 * 个推服务提供者
 * Class GetuiServiceProvider
 * @package Lysice\Getui
 */
class GetuiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = realpath(__DIR__.'/config/getui.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('getui.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('getui');
        }

        $this->mergeConfigFrom($source, 'getui');
    }

    /**
     * 注册单例
     */
    public function register()
    {
        $this->app->singleton(GetuiService::class, function () {
            return new GetuiService(config('getui.test'));
        });
    }
}
