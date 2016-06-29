<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>加粉助手</title>
    <meta name="keywords" content="加粉助手,微信加粉,微商助手"/>
    <meta name="description"
          content="考研帮，考研帮（kaoyan.com）倾力打造的手机APP应用，集院校资讯、考研经验、考研资料、考研论坛于一体的考研人的掌上家园！快下载考研帮，考研信息尽在掌握之中。"/>
    <link href="/Public/Home/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css"/>

    
    <link href="/Public/Home/css/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/agent.css" rel="stylesheet" type="text/css"/>

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
            <div class="aside">
                <ul class="agent-nav">
                    <li class="menu-item active">
                        <a href="/agent">主控面板</a>
                    </li>
                    <li class="menu-item">
                        <a href="/agent/orders">购买记录</a>
                    </li>
                    <li class="menu-item">
                        <a href="/agent/deposits">充值记录</a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="user-info">
                    <div class="info-item">
                        <div class="info-box">
                            <span class="info-box-icon icon-group"><i class="iconfont info-font-icon ">
                                &#xe65c;</i></span>
                            <div class="info-box-content">
                                <div class="info-box-title">你的代理等级</div>
                                <div class="info-box-text">
                                    <?php $groups=array('注册用户','授权经销商','特权经销商'); ?>
                                    <?php echo ($groups[$user['user_group']-1]); ?>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="info-item">
                        <div class="info-box">

                            <span class="info-box-icon icon-money"><i class="iconfont info-font-icon ">
                                &#xe65b;</i></span>

                            <div class="info-box-content">
                                <div class="info-box-title">当前单价</div>
                                <div class="info-box-text"><?php echo ($user["price"]); ?></div>

                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-box ">
                            <span class="info-box-icon icon-mobiles"><i class="iconfont info-font-icon ">
                                &#xe602;</i></span>
                            <div class="info-box-content">
                                <div class="info-box-title">剩余激活码数</div>
                                <div class="info-box-text"><?php echo ($user["codes"]); ?></div>

                            </div>
                        </div>
                    </div>


                    <div class="info-item">
                        <div class="info-box">
                            <span class="info-box-icon icon-recharge"><i class="iconfont info-font-icon ">
                                &#xe610;</i></span>
                            <div class="info-box-recharge">
                                <a href="agent/deposit">点击充值</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-content">

                    <div class="left">
                        <div class="form-title">获取激活码</div>
                        <form action="/getcode" type="POST" class="post-form">
                            <div class="form-text-area">
                                <input type="text" name="code" id="code" placeholder="输入手机的设备号" class="form-text">
                            </div>

                            <div class="button-wrap">
                                <div class="button-list">
                                    <div class="error-message"></div>
                                    <div>
                                        <input type="button" class="button-item false submit-button"
                                               onclick="getcode()" value="立即获取"/>
                                    </div>

                                    <div><a
                                            target="_blank" href="#"
                                            rel="在线咨询"
                                            class="button-item false">在线咨询</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="right">
                        <div class="vip-area">
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
                                    5：分销商后期补货是25元一个授权码,5个起<br/>
                                </div>
                            </div>
                        </div>

                        <div class="active-code-area" style="display: none">

                            <div class="active-code-title">当前激活码</div>
                            <div class="active-code">3/do5vBnQua5mUnHnjobCg==</div>
                            <div>
                                <input type="button" class="button-item false submit-button" onclick="copycode()"
                                       value="复制激活码">
                            </div>
                        </div>
                    </div>
                </div>

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
    <script type="text/javascript" src="/Public/vendor/zeroclipboard/ZeroClipboard.min.js"></script>
    <script type="text/javascript">
        function getcode() {
            var target, query, form;
            var that = this;
            form = $(".post-form");
            $(".submit-button").html("获取中...");
            query = form.find('input,select,textarea').serialize();
            target = $(".post-form").attr('action');
            $(".submit-button").addClass('disabled').attr('autocomplete', 'off').prop(
                    'disabled', true);
            $.post(target, query).success(
                    function (data) {
                        if (data.status == 1) {
                            $(".vip-area").hide();
                            $(".active-code-area").show()
                            $(".active-code").html(data.info);
                        } else {
                            $(".vip-area").show();
                            $(".active-code-area").hide()
                            $(".error-message").show();
                            $(".error-message").html(data.info);
                        }
                        $("#code").val('');
                        $(".submit-button").html("获取激活码");
                        $(".submit-button").removeClass('disabled').prop(
                                'disabled', false);
                    });

            return false;
        }

        function copycode()
        {

        }

    </script>


</body>
</html>