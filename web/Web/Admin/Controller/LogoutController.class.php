<?php
/**
 * author: rocks
 * date: 16/4/1
 * time: 上午10:37
 * email:980002549@qq.com
 */

namespace Admin\Controller;


use Think\Controller;

class LogoutController extends Controller
{

    public  function index()
    {
        session('admin',null);
        $this->success ( '已注销登录！', U ( "Admin/Login/index" ) );
    }
}