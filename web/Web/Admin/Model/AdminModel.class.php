<?php
/**
 * author: rocks
 * date: 16/3/29
 * time: 上午10:41
 * email:980002549@qq.com
 */

namespace Admin\Model;


use Think\Model;

class AdminModel extends Model
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

    public function login($username, $password)
    {
        $where ["username"] = $username;
        $where ["password"] = md5($password);
        $where['status'] = 1;
        $user = $this->where($where)->find();
        if ($user) {
            $result['admin_id'] = $user['admin_id'];
            $result['username'] = $user['username'];
            return $result;
        } else {
            return false;
        }
    }


    public function addAdmin($data)
    {
        $data = $this->create($data);
        if ($data) {
            $id = $this->add($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }

    public function editAdmin($data)
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