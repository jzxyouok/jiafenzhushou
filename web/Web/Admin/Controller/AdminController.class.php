<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 下午12:56
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class AdminController extends BaseController
{
    public function index()
    {
        $username = I('username');
        $map ['status'] = array(
            'egt',
            0
        );
        $map ['username'] = array(
            'like',
            '%' . ( string )$username . '%'
        );
        $list = $this->lists('Admin', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            $data ['username'] = I('username');
            $data ['password'] = I('password');
            $data['password'] = md5($data['password']);
            $Admin = D('Admin');
            if (false !== $Admin->addAdmin($data)) {
                $this->success('新增成功！', U('index'));
            } else {
                $error = $Admin->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {
            $this->display();
        }
    }

    public function edit($admin_id = null)
    {
        if (IS_POST) {
            $data ['admin_id'] = I('admin_id');
            $data ['username'] = I('username');
            if (I('password')) {
                $data ['password'] = I('password');
                $data['password'] = md5($data['password']);
            }
            $Admin = D('Admin');
            if (false !== $Admin->editAdmin($data)) {
                $this->success('更新成功！', U('index'));
            } else {
                $error = $Admin->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {
            if (!$admin_id) {
                $this->error('参数错误');
            }
            $admin = D('Admin')->find($admin_id);
            $this->assign('admin', $admin);
            $this->display();
        }
    }

    /**
     * 会员状态修改
     */
    public function changeStatus($method = null)
    {
        $id = array_unique(( array )I('admin_id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        if (empty ($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map ['admin_id'] = array(
            'in',
            $id
        );

        switch (strtolower($method)) {
            case 'forbid' :
                $this->forbid('Admin', $map);
                break;
            case 'resume' :
                $this->resume('Admin', $map);
                break;
            case 'delete' :
                $this->delete('Admin', $map);
                break;
            default :
                $this->error('参数非法');
        }
    }
}