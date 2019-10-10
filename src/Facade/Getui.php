<?php

namespace Lysice\Getui\Facade;

use Illuminate\Support\Facades\Facade;
use Lysice\Getui\GetuiService;

/**
 * 个推对外服务
 * Class Getui
 * @package Lysice\Getui\Facade
 * @method static pushToSingle(string $type, array $data)
 * @method static pushToApp(string $type, array $data)
 * @method static pushToList(string $type, array $data)
 */
class Getui extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GetuiService::class;
    }
}
