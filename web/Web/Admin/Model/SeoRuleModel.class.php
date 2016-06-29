<?php
/**
 * author: rocks
 * date: 16/6/20
 * time: 上午10:57
 * email:980002549@qq.com
 */

namespace Admin\Model;


use Think\Model;

class SeoRuleModel extends Model
{
    /**
     * 自动完成
     * @author rocks
     */
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT),
    );

    public function addRule($data)
    {
        $data = $this->create($data);
        if ($data) {
            $id = $this->add($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }

    public function editRule($data)
    {
        $data = $this->create($data, 2);
        if ($data) {
            $id = $this->save($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }
}