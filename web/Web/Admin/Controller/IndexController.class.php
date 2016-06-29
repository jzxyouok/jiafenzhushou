<?php
/**
 * author: rocks
 * date: 16/5/29
 * time: 上午11:07
 * email:980002549@qq.com
 */

namespace Admin\Controller;


use Think\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $news_count = M('News')->count();
        $this->assign('news_count', $news_count);

        $user_count = M('User')->count();
        $this->assign('user_count', $user_count);

        $order_count = M('Order')->where('pay_status>0')->count();
        $this->assign('order_count', $order_count);

        $money_count = M('Order')->where('user_id=0&pay_status>0')->sum('price');

        $deposit_count = M('Deposit')->sum('money');

        $this->assign('total_money', $money_count + $deposit_count);

        $lines = array();

        $today = strtotime(date('Y-m-d'));
        for ($i = 8; $i--; $i > 0) {
            $lastday = $today - 24 * 60 * 60 * $i;
            $currentday = $today - 24 * 60 * 60 * ($i - 1);

            if ($i == 1) {
                $preday = time() - 24 * 60 * 60 * ($i - 1);
            } else {
                $preday = $currentday;
            }

            $count = M('Order')->where('pay_status=1 and user_id=0 and create_time >' . $lastday . ' and create_time< ' . $preday)->sum('price');
            $money = M('Deposit')->where('pay_status=1 and create_time >' . $lastday . ' and create_time< ' . $preday)->sum('money');
            $time = time() - 24 * 60 * 60 * $i;
            $date = date("Y-m-d", $time);
            $day['date'] = $date;
            $day['count'] = $count+$money;
            $lines[] = $day;
        }

        $this->assign('lines', $lines);

        $this->display();

    }
}