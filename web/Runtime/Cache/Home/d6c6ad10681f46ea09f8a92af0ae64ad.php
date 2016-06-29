<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php $oneplus_seo_meta = get_seo_meta($vars,$seo); ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title>加粉助手</title><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>

       <link href="/Public/Home/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css"/>

    
    <link href="/Public/Home/css/login.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<!--header start-->
<div id="header">
    <div class="area clear">
        <a href="http://www.jiafenzhushou.com/" title="加粉助手" class="logo">
            <img src="/Public/Home/images/logo.jpg" alt="加粉助手"/></a>
        <ul class="nav">
            <li><a href="/" title="首页">首页</a></li>
            <li><a href="/apps" title="软件下载">软件下载</a></li>
            <li><a href="/buy" title="在线购买">在线购买</a></li>
            <li><a href="/agent" title="代理合作">代理合作</a></li>
            <li><a href="/news" title="微商教程">微商教程</a></li>
            <li><a href="/contact" title="联系我们">联系我们</a></li>
        </ul>
    </div>
</div>



    <div class="main">
        <div class="main-content">
            <div class="left">
                <div class="vip">
                    <div class="vip-title">特约经销商<span class="price">400元</span></div>
                    <div class="vip-content">
                        1：包含10个正版软件授权码可售<br/>
                        2：开通代理商授权系统账号一个<br/>
                        3：全程专业技术指导咨询服务<br/>
                        4：帮助代理商打造分销团队计划，实现业绩倍增<br/>
                        5：提供官方实时在线技术支持<br/>
                        6：代理商后期补货是15元一个授权码，10个起<br/>
                        7：及时分享各种在线项目合作<br/>
                    </div>
                </div>

                <div class="vip">
                    <div class="vip-title">授权分销商<span class="price">250元</span></div>
                    <div class="vip-content">
                        1：包含5个正版软件授权码可售<br/>
                        2：开通授权分销商系统账号一个<br/>
                        3：全程专业技术指导咨询服务<br/>
                        4：提供官方实时在线技术支持<br/>
                        5：分销商后期补货是25元一个授权码,5个起
                    </div>
                </div>

            </div>
            <div class="right">
                <div class="form-title">代理系统登录</div>
                <form action="/login" type="POST" class="post-form">
                <div class="form-text-area">
                    <input type="text" name="email" placeholder="请输入email" class="form-text">
                    <input type="password" name="password" placeholder="请输入密码" class="form-text">
                </div>
                <div class="button-wrap">
                    <div class="button-list">
                        <div class="error-message"></div>
                        <div>
                            <input type="button" class="button-item false submit-button" onclick="login()" value="立即登录"/>
                        </div>
                        <div><a
                                 href="/register"
                                rel="立即注册"
                                class="button-item false">立即注册</a>
                        </div>
                        <div><a
                                target="_blank" href="#"
                                rel="忘记密码"
                                class="button-item false">忘记密码</a>
                        </div>
                        <div><a
                                target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2462295667&site=qq&menu=yes"
                                rel="在线咨询"
                                class="button-item false">在线咨询</a>
                        </div>
                    </div>
                </div>
                    </form>
            </div>
        </div>
    </div>



<footer class="global-footer">

    <div class="copyright-box">
        <p>© 2016-2016 jiafenzhushou.com. All Rights Reserved.&nbsp;&nbsp;&nbsp;&nbsp;版权所有&nbsp;&nbsp;<a
                rel="nofollow" target="_blank" href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action">蜀ICP备08111247号-12</a>
        </p>
        <p>不封号的加粉软件,微商从此开始！</p>
    </div>

</footer>

    <script type="text/javascript" src="/Public/Home/js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript">
        function login() {
            var target, query, form;
            var that = this;
            form = $(".post-form");
            $(".submit-button").html("登陆中...");
            query = form.find('input,select,textarea').serialize();
            target = $(".post-form").attr('action');
            $(".submit-button").addClass('disabled').attr('autocomplete', 'off').prop(
                    'disabled', true);
            $.post(target, query).success(
                    function (data) {
                        if (data.status == 1) {
                            if (data.url) {
                                location.href = data.url;
                            }
                        } else {
                            $(".submit-button").html("登陆");
                            $(that).removeClass('disabled').prop(
                                    'disabled', false);
                            $(".error-message").show();
                            $(".error-message").html(data.info);
                        }
                    });

            return false;
        }

    </script>


<div style="display: none">

    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?89e2c02dd1320bb22b3d57e97dbb66d1";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

</div>
</body>
</html>