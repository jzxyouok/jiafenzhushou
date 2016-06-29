<?php
/**
 * author: rocks
 * date: 16/6/10
 * time: 下午9:29
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class DepositController extends BaseController
{

    public function index()
    {
        $map ['status'] = 1;
        $map['pay_status'] = 1;
        $list = $this->lists('Deposit', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            $money = I('money');
            $email = I('email');
            $map['email'] = $email;
            $user = M('User')->where($map)->find();

            if (empty($user)) {
                $this->error('没有该用户');
            }

            if ($money > 400) {
                $user['user_group'] = 2;
                $user['price'] = 10;
            } elseif ($money > 250) {
                $user['user_group'] = 1;
                $user['price'] = 15;
            }


            $count = ceil($money / $user['price']);
            $user['total_money'] = $user['total_money'] + $money;
            $user['total_count'] = $user['total_count'] + $count;
            $user['codes'] = $user['codes'] + $count;
            M('User')->save($user);


            $deposit['deposit_no'] = uniqid();
            $deposit['user_id'] = $user['user_id'];
            $deposit['user_group'] = $user['user_group'];
            $deposit['money'] = $money;
            $deposit['codes'] = $count;
            $deposit['price'] = $user['price'];
            $deposit['pay_status'] = 1;
            $deposit['create_time'] = time();
            $deposit['update_time'] = time();
            $deposit['status'] = 1;

            $Deposit = M('Deposit');
            if (false !== $Deposit->add($deposit)) {
                $this->success('新增成功！', U('index'));
            } else {
                $error = $Deposit->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }

        } else {
            $this->display();
        }
    }


    public function changeStatus($method = null)
    {
        $id = array_unique(( array )I('order_id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        if (empty ($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map ['order_id'] = array(
            'in',
            $id
        );

        switch (strtolower($method)) {
            case 'forbid' :
                $this->forbid('Deposit', $map);
                break;
            case 'resume' :
                $this->resume('Deposit', $map);
                break;
            case 'delete' :
                $this->delete('Deposit', $map);
                break;
            default :
                $this->error('参数非法');
        }
    }

}