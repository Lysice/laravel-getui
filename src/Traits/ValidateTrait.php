<?php

namespace Lysice\Getui\Traits;
use Exception;

trait ValidateTrait
{
    /**
     * 验证字段
     * @param array $fields
     * @param array $data
     * @throws Exception
     */
    private function validateFields(array $fields = [], array $data = [])
    {
        foreach ($fields as $field) {
            if (is_null($data[$field])) {
                throw new Exception("字段" . $field . "不存在!");
            }
        }
    }
}

