<?php
/**
 * author: rocks
 * date: 16/6/4
 * time: 下午6:51
 * email:980002549@qq.com
 */

namespace Home\Model;


use Think\Model;

class UserModel extends Model
{
    protected $_validate = array(
        array('nickname', 'require', '用户名不能为空'),
        array('email', 'email', '请输入合法邮箱', self::EXISTS_VALIDATE, 'regex',self::MODEL_INSERT),
        array('password', '6,30', "请输入6位数以上的密码", self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array(
            'nickname',
            'checkNickName',
            '昵称已经存在',
            self::EXISTS_VALIDATE,
            'callback'
        ),
        array(
            'email',
            'checkEmail',
            '邮箱已经存在',
            self::EXISTS_VALIDATE,
            'callback'
        )

    );



    public function checkEmail($mail)
    {
        $map['email'] = $mail;
        $map['status'] = array('gt', -1);
        if ($this->where($map)->find()) return false;
        return true;
    }

    public function checkNickName($nickname)
    {
        $map['nickname'] = $nickname;
        $map['status'] = array('gt', -1);
        if ($this->where($map)->find()) return false;
        return true;
    }

    /**
     * 自动完成
     * @author rocks
     */
    protected $_auto = array(
        array(
            'login_ip',
            'get_client_ip',
            self::MODEL_BOTH,
            'function',
            1
        ),
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
    );

    public function addUser($data)
    {
        $data = $this->create($data);
        if ($data) {
            $data['password'] = md5($data['password']);
            $id = $this->add($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }

    public function editUser($data)
    {
        $data = $this->create($data, 2);
        if ($data) {
            $id = $this->save($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }

    public function editPassword($mobile, $password)
    {
        $password = md5($password);
        $map['mobile'] = $mobile;
        $map['status'] = 1;
        $user = $this->where($map)->order('user_id desc')->find();
        if (empty($user)) {
            return false;
        } else {
            $user['password'] = $password;
        }
        $user['update_time']=time();
        $id = $this->save($user);
        return $id ? true : false;

    }

}