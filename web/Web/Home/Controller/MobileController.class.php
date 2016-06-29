<?php
/**
 * author: rocks
 * date: 16/6/19
 * time: 下午7:54
 * email:980002549@qq.com
 */

namespace Home\Controller;


use Think\Controller;

class MobileController extends Controller
{

    public function feedback()
    {
        header("Location:http://wpa.qq.com/msgrd?v=3&uin=2462295667&site=qq&menu=yes");
    }

    public function buy()
    {
        header("Location:https://item.taobao.com/item.htm?id=534114054883");
    }
    public function qun()
    {
        header("Location:http://shang.qq.com/wpa/qunwpa?idkey=389a2c225a3ee37afe868d1dcd73137fd19e2d1251561f941757cd9bb1f62667");
    }
    public function app()
    {
        header("Location:http://www.jiafenzhushou.com/apps");

    }
}