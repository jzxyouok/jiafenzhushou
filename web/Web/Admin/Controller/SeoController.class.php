<?php
/**
 * author: rocks
 * date: 16/6/20
 * time: 上午12:35
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class SeoController extends BaseController
{
    public function index()
    {
        $map ['status'] = array(
            'egt',
            0
        );
        $list = $this->lists('SeoRule', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function add()
    {

        if (IS_POST) {
            $data = I("post.");
            $SeoRule = D('SeoRule');
            clean_all_cache();
            if (false !== $SeoRule->addRule($data)) {
                $this->success('新增成功！', U('index'));
            } else {
                $error = $SeoRule->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }

        } else {
            $this->display();
        }
    }

    public function edit($id = null)
    {
        if (IS_POST) {
            $data = I("post.");
            $SeoRule = D('SeoRule');
            clean_all_cache();
            if (false !== $SeoRule->editRule($data)) {
                $this->success('更新成功！', U('index'));
            } else {
                $error = $SeoRule->getError();
                $this->error(empty ($error) ? '未知错误！' : $error);
            }

        } else {
            if (!$id) {
                $this->error('参数错误');
            }
            $seo = D('SeoRule')->find($id);
            $this->assign('seo', $seo);
            $this->display();
        }
    }

}