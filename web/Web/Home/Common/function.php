<?php
/**
 * author: rocks
 * date: 16/4/27
 * time: 下午10:13
 * email:980002549@qq.com
 */


function get_nickname($user_id)
{
    return M('User')->getFieldById($user_id, 'nickname');
}


function get_usergroup($user_id)
{
    return M('User')->getFieldById($user_id, 'user_group');
}

/**
 * 数据签名认证
 *
 * @param array $data
 *            被认证的数据
 * @return string 签名
 * @author Rocks
 */
function data_auth_sign($data)
{
    // 数据类型检测
    if (!is_array($data)) {
        $data = ( array )$data;
    }
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = sha1($code); // 生成签名
    return $sign;
}


/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author Rocks
 */
function is_login()
{
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['user_id'] : 0;
    }
}
