<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 下午2:02
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class OrderController extends  BaseController
{
    public function index()
    {
        $map ['status'] = array(
            'egt',
            0
        );
        $map['pay_status']=1;
        $list = $this->lists('Order', $map);
        $this->assign('_list', $list);
        $this->display();
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
                $this->forbid('Order', $map);
                break;
            case 'resume' :
                $this->resume('Order', $map);
                break;
            case 'delete' :
                $this->delete('Order', $map);
                break;
            default :
                $this->error('参数非法');
        }
    }
}