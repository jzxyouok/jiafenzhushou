<?php
/**
 * author: rocks
 * date: 16/6/2
 * time: 下午1:17
 * email:980002549@qq.com
 */

namespace Home\Controller;


use Think\Controller;

class BaseController extends Controller
{

    protected $user_id = 0;

    /**
     * 前台控制器初始化
     */
    protected function _initialize()
    {
        $this->initUser();
    }

    private function initUser()
    {
        if ($this->isLogged()) {
            $this->user_id = $this->getCookieUid();
        }
    }


    /**
     * 验证用户是否已登录
     * 按照session -> cookie的顺序检查是否登陆
     *
     * @return boolean 登陆成功是返回true, 否则返回false
     */
    public function isLogged()
    {
        // 验证本地系统登录
        if (is_login()) {
            return true;
        } else if ($user_id = $this->getCookieUid()) {
            return $this->_recordLogin($user_id);
        } else {
            $this->logout();
            return false;
        }
    }


    /**
     * 自动登录用户
     *
     * @param integer $user
     *            用户信息数组
     */
    public function autoLogin($user)
    {
        $auth = array(
            'user_id' => $user ['user_id'],
            'nickname' => $user['nickname'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
        if (!$this->getCookieUid()) {
            cookie('JZ_LOGGED_USER', $this->jiami($this->change() . ".{$user['user_id']}"));
        }
    }

    /**
     * 设置登录状态、记录登录日志
     *
     * @param integer $user_id
     *            用户ID
     * @param boolean $is_remember_me
     *            是否记录登录状态，默认为false
     * @return boolean 操作是否成功
     */
    protected function _recordLogin($user_id)
    {
        if (!$this->getCookieUid()) {
            cookie('JZ_LOGGED_USER', $this->jiami($this->change() . ".$user_id."));
        }
        $auth = array(
            'user_id' => $user_id,
            'nickname' => get_nickname($user_id),
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
        return true;
    }


    public function getCookieUid()
    {
        static $cookie_user_id = null;
        if (isset ($cookie_user_id) && $cookie_user_id !== null) {
            return $cookie_user_id;
        }
        $cookie = cookie('JZ_LOGGED_USER');
        $cookie = explode(".", $this->jiemi($cookie));
        $cookie_user_id = ($cookie [0] != $this->change()) ? false : $cookie [1];
        return $cookie_user_id;
    }

    /**
     * 加密函数
     *
     * @param string $txt
     *            需加密的字符串
     * @param string $key
     *            加密密钥，默认读取SECURE_CODE配置
     * @return string 加密后的字符串
     */
    private function jiami($txt, $key = null)
    {
        empty ($key) && $key = $this->change();
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
        $nh = rand(0, 64);
        $ch = $chars [$nh];
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
        $txt = base64_encode($txt);
        $tmp = '';
        $i = 0;
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh + strpos($chars, $txt [$i]) + ord($mdKey [$k++])) % 64;
            $tmp .= $chars [$j];
        }
        return $ch . $tmp;
    }

    /**
     * 解密函数
     *
     * @param string $txt
     *            待解密的字符串
     * @param string $key
     *            解密密钥，默认读取SECURE_CODE配置
     * @return string 解密后的字符串
     */
    private function jiemi($txt, $key = null)
    {
        empty ($key) && $key = $this->change();
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
        $ch = $txt [0];
        $nh = strpos($chars, $ch);
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
        $txt = substr($txt, 1);
        $tmp = '';
        $i = 0;
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = strpos($chars, $txt [$i]) - $nh - ord($mdKey [$k++]);
            while ($j < 0) {
                $j += 64;
            }
            $tmp .= $chars [$j];
        }
        return base64_decode($tmp);
    }

    private function change()
    {
        preg_match_all('/\w/', C('DATA_AUTH_KEY'), $sss);
        $str1 = '';
        foreach ($sss [0] as $v) {
            $str1 .= $v;
        }
        return $str1;
    }

    /**
     * 注销当前用户
     *
     * @return void
     */
    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
        cookie('JZ_LOGGED_USER', NULL);
    }
}