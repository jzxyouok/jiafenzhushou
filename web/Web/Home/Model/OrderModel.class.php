<?php
/**
 * author: rocks
 * date: 16/6/8
 * time: 下午10:28
 * email:980002549@qq.com
 */

namespace Home\Model;


use Think\Model;

class OrderModel extends Model
{

    /**
     * 自动完成
     * @author rocks
     */
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
    );


    public function addOrder($data)
    {
        $data = $this->create($data);
        if ($data) {
            $id = $this->add($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }
}