<?php
/**
 * author: rocks
 * date: 16/5/29
 * time: 上午11:07
 * email:980002549@qq.com
 */

namespace Home\Controller;


use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $list = M('News')->field('news_id,title,description,thumb')->order('news_id desc')->limit(0, 20)->select();
        $this->assign('_list', $list);
        $this->display();
    }
}