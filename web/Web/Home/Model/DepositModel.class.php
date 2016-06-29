<?php
/**
 * author: rocks
 * date: 16/6/13
 * time: 下午4:33
 * email:980002549@qq.com
 */

namespace Home\Model;


use Think\Model;

class DepositModel extends Model
{

    /**
     * 自动完成
     * @author rocks
     */
    protected $_auto = array(
        array('deposit_no', 'uniqid', self::MODEL_INSERT, 'function', 1),
        array('pay_status', 0, self::MODEL_INSERT),
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
    );

    public function addDeposit($data)
    {
        $data = $this->create($data);
        if ($data) {
            $id = $this->add($data);
            return $id ? $data['deposit_no'] : 0;
        } else {
            return false;
        }
    }

    public function editDeposit($data)
    {
        $data = $this->create($data, 2);
        if ($data) {
            $id = $this->save($data);
            return $id ? $data['deposit_no'] : 0;
        } else {
            return false;
        }
    }

}