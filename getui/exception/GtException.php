<?php

class GtException extends Exception
{
    var $requestId;
    //重定义构造器使第一个参数 message 变为必须被指定的属性
    public function __construct(...$param){
        $args_num = count($param);
        if ($args_num == 0){//无参构造
            parent::__construct();
        }elseif ($args_num == 1){//message 构造
            parent::__construct($param[0]);
        }elseif ($args_num == 3){//$requestId，$message, $e 三参数构造
            parent::__construct($param[1],null, $param[2]);
            $this->requestId = $param[0];
        }
    }

    public function getRequestId()
    {
        return $this->requestId;
    }
}