<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 上午9:27
 * email:980002549@qq.com
 */

namespace Admin\Controller;


class PictureController extends BaseController
{

    public function upload()
    {

        $upload = new \Think\Upload(C('THUMB_UPLOAD'));// 实例化上传类
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
            return;
        } else {// 上传成功 获取上传文件信息
            $url =  $upload->rootPath.$info['file']['savepath'].$info['file']['savename'];
            return $this->ajaxReturn($url);
        }
    }

}