<?php
/**
 * author: rocks
 * date: 16/6/10
 * time: 下午2:19
 * email:980002549@qq.com
 */

namespace Admin\Controller;


use Think\Controller;

class LoginController extends  Controller
{
    public function index($username = null, $password = null)
    {
        if (IS_POST) {
            $result = D('Admin')->login($username, $password);
            $data = array();
            if ($result) {
                session("admin",$result);
                $data['status'] = 1;
                $data['url'] = U('Admin/Index/index');
                $data['message'] = "登陆成功";
            } else {
                $data['status'] = 0;
                $data['message'] = "用户或密码错误";
            }
            $this->ajaxReturn($data);
        } else {
            if (session("admin")) {
                $this->redirect("Admin/Index/index");
            }
            $this->display();
        }

    }
}