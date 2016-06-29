<?php
/**
 * author: rocks
 * date: 16/3/29
 * time: 上午10:27
 * email:980002549@qq.com
 */
/**
 * 检测用户是否登录
 *
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author Rocks
 */
function get_username($user_id)
{
    return M("User")->where('user_id=' . $user_id)->getField('nickname');
}

function get_email($user_id)
{
    return M("User")->where('user_id=' . $user_id)->getField('email');
}
