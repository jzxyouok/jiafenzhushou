<?php
/**
 * author: rocks
 * date: 16/6/11
 * time: 上午1:23
 * email:980002549@qq.com
 */

namespace Home\Controller;


use Think\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $list = M('News')->field('news_id,title,description,thumb')->order('news_id desc')->limit(0, 20)->select();
        $this->assign('_list', $list);
        $this->display();

    }

    public function loadmore($page)
    {
        $items = M('News')->field('news_id,title,description,thumb')->order('news_id desc')->limit($page * 20, 2)->select();
        $this->ajaxReturn($items);
    }

    public function detail($news_id=0)
    {
        $news=M('News')->where('status=1')->find($news_id);
        if(empty($news))
        {
            $this->error("不存在");
        }
        $this->assign('news',$news);
        M('News')->where('news_id='.$news_id)->setInc("views");
        $this->display();
    }

}