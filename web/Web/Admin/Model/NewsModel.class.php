<?php
/**
 * author: rocks
 * date: 16/3/30
 * time: 上午12:14
 * email:980002549@qq.com
 */

namespace Admin\Model;


use Think\Model;

class NewsModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '标题名称必须填写'),
        array('content', 'require', '标题名称必须填写'),
        array('description', 'require', '简要必须填写'),
    );
    /**
     * 自动完成
     * @author rocks
     */
    protected $_auto = array(
        array('views', 0, self::MODEL_INSERT),
        array('status', 1, self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
    );

    public function addNews($data)
    {
        $data = $this->create($data);
        if ($data) {
            $id = $this->add($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }

    public function editNews($data)
    {
        $data = $this->create($data, 2);
        if ($data) {
            $id = $this->save($data);
            return $id ? $id : 0;
        } else {
            return false;
        }
    }


}