<?php
/**
 * author: rocks
 * date: 16/6/2
 * time: 下午1:21
 * email:980002549@qq.com
 */

namespace Home\Controller;


use Think\Controller;

class UserController extends BaseController
{

    public function login()
    {

        if (IS_POST) {
            $mail = I('email');
            $password = I('password');
            $map['email'] = $mail;
            $map['password'] = md5($password);
            $map['status'] = 1;
            $user = M('User')->where($map)->order('user_id desc')->find();
            if ($user) {
                $this->_recordLogin($user['user_id']);
                $this->success("登陆成功", U('/agent'), IS_AJAX);
            } else {
                $this->error("用户或者密码错误", "", IS_AJAX);
            }
        } else {
            $this->display();
        }

    }

    public function register()
    {

        if (IS_POST) {
            $data = I("post.");
            $User = D('User');
            $user_id = $User->addUser($data);
            if ($user_id) {
                $this->_recordLogin($user_id);
                $this->success("注册成功", U('/agent'), IS_AJAX);
            } else {
                $this->error($User->getError(), "", IS_AJAX);
            }

        } else {
            $this->display();
        }
    }
}