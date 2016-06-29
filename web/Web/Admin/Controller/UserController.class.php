<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 下午1:19
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class UserController extends  BaseController
{
    public function index()
    {
        $mobile = I('mobile');
        $map ['status'] = array(
            'egt',
            0
        );
        $map['nickname']= array('like','%'.$mobile.'%');
        $list = $this->lists('User', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            $data ['nickname'] = I('nickname');
            $data ['user_group'] = I('user_group');
            if (I('password')) {
                $data ['password'] = I('password');
                $data['password'] = md5($data['password']);
            }
            $User = D('User');
            if (false !== $User->addUser($data)) {
                $this->success('更新成功！', U('index'));
            } else {
                $error = $User->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {

            $this->display();
        }
    }

    public function edit($user_id = null)
    {
        if (IS_POST) {
            $data ['user_id'] = I('user_id');
            $data ['nickname'] = I('nickname');
            $data ['user_group'] = I('user_group');
            if (I('password')) {
                $data ['password'] = I('password');
                $data['password'] = md5($data['password']);
            }
            $User = D('User');
            if (false !== $User->editUser($data)) {
                $this->success('更新成功！', U('index'));
            } else {
                $error = $User->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {
            if (!$user_id) {
                $this->error('参数错误');
            }
            $user = D('User')->find($user_id);
            $this->assign('user', $user);
            $this->display();
        }
    }

    /**
     * 会员状态修改
     */
    public function changeStatus($method = null)
    {
        $id = array_unique(( array )I('user_id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        if (empty ($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map ['user_id'] = array(
            'in',
            $id
        );

        switch (strtolower($method)) {
            case 'forbid' :
                $this->forbid('User', $map);
                break;
            case 'resume' :
                $this->resume('User', $map);
                break;
            case 'delete' :
                $this->delete('User', $map);
                break;
            default :
                $this->error('参数非法');
        }
    }

}