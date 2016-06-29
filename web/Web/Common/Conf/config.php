<?php
/**
 * author: rocks
 * date: 16/5/31
 * time: 上午12:32
 * email:980002549@qq.com
 */

return array(

    'URL_MODEL' => 2,
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' => array(
        'apps' => array('Home/App/index'),
        'buy' => array('Home/Buy/index'),
        'agent/orders' => array('Home/Agent/orders'),
        'agent/promote' => array('Home/Agent/promote'),
        'agent/deposit' => array('Home/Agent/deposit'),
        'agent/deposits' => array('Home/Agent/deposits'),
        'deposit/notify' => array('Home/Deposit/notify'),
        'promote/notify' => array('Home/Promote/notify'),
        'order/notify' => array('Home/Order/notify'),
        'agent' => array('Home/Agent/index'),
        'login' => array('Home/User/login'),
        'register' => array('Home/User/register'),
        'getcode' => array('Home/Agent/getcode'),
        'deposit' => array('Home/Deposit/index'),
        '/^news\/(\d+)$/' => array('Home/News/detail?news_id=:1'),
        'news' => array('Home/News/index'),
        'contact' => array('Home/Contact/index'),
        'mobile/feedback'=>array('Home/Mobile/feedback'),
        'mobile/buy'=>array('Home/Mobile/buy'),
        'mobile/qun'=>array('Home/Mobile/qun'),
        'mobile/app'=>array('Home/Mobile/app'),
    ),


    'DB_TYPE' => 'mysqli',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'jiafenzhushou',
    'DB_USER'=>'hudouban',
    'DB_PWD'=>'hudouban#147258',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'jz_',



    'ONLINE_QQ' => '2462295667',
    'QQ_GROUP_1' => '453300381',
    'QQ_GROUP_2' => '214084535',
    'QQ_GROUP_3' => '318055469',
    'IOS_URL' => 'http://fir.im/lbpf',
    'ANDROID_URL' => 'http://pkg3.fir.im/5c18ab76be01086e9782cccd6f52881e78a0defb.apk?attname=jfzs.apk_1.0.apk',


    /* 图片上传相关配置 */
    'THUMB_UPLOAD' => array(
        'mimes' => '',
        'maxSize' => 2 * 1024 * 1024,
        'exts' => 'jpg,gif,png,jpeg',
        'autoSub' => true,
        'subName' => array(
            'date',
            'Y/md/h'
        ),
        'rootPath' => 'Uploads/',
        'savePath' => 'thumb/',
        'saveName' => array(
            'uniqid',
            ''
        ),
        'saveExt' => '',
        'replace' => false,
        'hash' => true,
        'callback' => false
    ),

    'PICTURE_UPLOAD_DRIVER' => 'Local',
    // 本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG' => array(),

    'SESSION_PREFIX' => 'jz_',
    'COOKIE_PREFIX' => 'jz_',
    'VAR_SESSION_ID' => 'session_id',

);