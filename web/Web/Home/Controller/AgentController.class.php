<?php
/**
 * author: rocks
 * date: 16/6/2
 * time: 下午1:17
 * email:980002549@qq.com
 */

namespace Home\Controller;

class AgentController extends AgentBaseController
{

    public function index()
    {

        $user = M('User')->find($this->user_id);
        $this->assign('user', $user);
        $this->display();
    }

    public function getcode($code)
    {
        $user = M('User')->find($this->user_id);
        if ($user['codes'] <= 0) {
            $data['status'] = 0;
            $data['info'] = "请充值";
            $this->ajaxReturn($data);
            return;
        }
        $map['code'] = $code;
        $map['pay_status'] = 1;
        $map['status'] = 1;
        $map['user_id'] = $this->user_id;

        //判断是否数据库存在
        $order = M('Order')->where($map)->find();
        if (!empty($order)) {
            $data['status'] = 1;
            $data['info'] = $order['decode'];
            $this->ajaxReturn($data);
            return;
        }

        //更改用户数据
        $user['codes'] = $user['codes'] - 1;
        $user['total_codes'] = $user['total_codes'] + 1;
        D('User')->save($user);

        $des = new DES3();
        $result = $des->encrypt($code);

        //添加订单
        $data['code'] = $code;
        $data['decode'] = $result;
        $data['user_id'] = $this->user_id;
        $data['price'] = $user['price'];
        $data['pay_status'] = 1;
        D('Order')->addOrder($data);

        $data['status'] = 1;
        $data['info'] = $result;
        $this->ajaxReturn($data);
    }

    public function orders()
    {
        $map ['status'] = 1;
        $map['pay_status'] = 1;
        $map['user_id'] = $this->user_id;
        $list = $this->lists('Order', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function deposits()
    {
        $map ['status'] = 1;
        $map['pay_status'] = 1;
        $map['user_id'] = $this->user_id;
        $list = $this->lists('Deposit', $map);
        $this->assign('_list', $list);
        $this->display();
    }

    public function deposit()
    {
        if (IS_POST) {

            header("Location:https://item.taobao.com/item.htm?id=534114054883");

        } else {
            $user = M('User')->find($this->user_id);
            $this->assign('user', $user);
            $this->display();
        }


    }

    public function promote($group = 2)
    {
        if ($group == 0 || $group > 2) {
            $this->error("没有这个权限");
        }

        $data['user_id'] = $this->user_id;
        $data['user_group'] = $group;

        if ($group == 1) {
            header("Location:https://item.taobao.com/item.htm?id=534142173193");
        } else {
            header("Location:https://item.taobao.com/item.htm?id=534176964766");
        }


    }


}

class DES3
{
    var $key = "jiafenzhushou/1472583?#@";
    var $iv = "14725836";

    function encrypt($input)
    {
        $size = mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC);
        $input = $this->pkcs5_pad($input, $size);
        $key = str_pad($this->key, 24, '0');
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        if ($this->iv == '') {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        } else {
            $iv = $this->iv;
        }
        @mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    function decrypt($encrypted)
    {
        $encrypted = base64_decode($encrypted);
        $key = str_pad($this->key, 24, '0');
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        if ($this->iv == '') {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        } else {
            $iv = $this->iv;
        }
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y = $this->pkcs5_unpad($decrypted);
        return $y;
    }

    function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    function PaddingPKCS7($data)
    {
        $block_size = mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC);
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char), $padding_char);
        return $data;
    }
}
