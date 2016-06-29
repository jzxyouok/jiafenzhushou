<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 上午12:00
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class NewsController extends BaseController
{
    public function index()
    {

        $q = I('title');
        $map ['status'] = array(
            'egt',
            0
        );
        $map ['title'] = array(
            'like',
            '%' . ( string )$q . '%'
        );
        $list = $this->lists('News', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function add()
    {

        if (IS_POST) {
            $data = I("post.");
            $News = D('News');
            if (false !== $News->addNews($data)) {
                $this->success('新增成功！', U('index'));
            } else {
                $error = $News->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {
            $this->display();
        }
    }

    public function edit($news_id = null)
    {
        if (IS_POST) {
            $data = I("post.");
            $News = D('News');
            if (false !== $News->editNews($data)) {
                $this->success('更新成功！', U('index'));
            } else {
                $error = $News->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }
        } else {
            if (!$news_id) {
                $this->error('参数错误');
            }
            $news = D('News')->find($news_id);
            $this->assign('news', $news);
            $this->display();
        }
    }



    /**
     * 会员状态修改
     */
    public function changeStatus($method = null)
    {
        $id = array_unique(( array )I('news_id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        if (empty ($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map ['news_id'] = array(
            'in',
            $id
        );

        switch (strtolower($method)) {
            case 'forbid' :
                $this->forbid('News', $map);
                break;
            case 'resume' :
                $this->resume('News', $map);
                break;
            case 'delete' :
                $this->delete('News', $map);
                break;
            default :
                $this->error('参数非法');
        }
    }

}