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
                                <a href="/deposit">点击充值</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-content">

                    <div class="left">
                        <form action="" type="post" id="deposit_form">
                            <div class="deposit_area">
                                <div class="deposit_num_title">充值个数</div>
                                <div class="deposit_num">
                                    <?php if(($user['user_group']) == "0"): ?><ul>
                                            <li>1</li>
                                            <li>10</li>
                                            <li>20</li>
                                            <li>50</li>
                                            <li>100</li>
                                        </ul><?php endif; ?>

                                    <?php if(($user['user_group']) == "1"): ?><ul>
                                            <li>5</li>
                                            <li>10</li>
                                            <li>20</li>
                                            <li>50</li>
                                            <li>100</li>
                                        </ul><?php endif; ?>
                                    <?php if(($user['user_group']) == "3"): ?><ul>
                                            <li>10</li>
                                            <li>20</li>
                                            <li>50</li>
                                            <li>100</li>
                                            <li>200</li>
                                        </ul><?php endif; ?>
                                </div>
                                <div class="other_num"><span>其他数量:</span>
                                    <input type="number" name="number" id="number">
                                <span>
                                     <?php if(($user['user_group']) == "0"): ?>请输入大于1的个数<?php endif; ?>

                                <?php if(($user['user_group']) == "1"): ?>请输入5的倍数<?php endif; ?>
                                <?php if(($user['user_group']) == "3"): ?>请输入10的倍数<?php endif; ?>
                                </span>
                                </div>

                                <div class="deposit_group_title">升级代理</div>
                                <div class="deposit_group">
                                    <?php if(($user['user_group']) == "0"): ?><ul>
                                            <li value="400">授权分销商</li>
                                            <li value="250">特许经销商</li>
                                        </ul><?php endif; ?>
                                    <?php if(($user['user_group']) == "1"): ?><ul>
                                            <li value="400">授权分销商</li>
                                        </ul><?php endif; ?>
                                </div>

                                <div class="deposit_money">总价格:0元</div>
                                <div class="deposit_submit"><input type="submit" class="deposit_submit_button"
                                                                   value="提交">
                                </div>
                            </div>
                    </div>
                    </form>
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
    <script type="text/javascript">
        price = <?php echo ($user["price"]); ?>
        ;
        group = <?php echo ($user["user_group"]); ?>
        ;

        $(".deposit_num li").click(function () {
            $(".deposit_num li").removeClass("active");
            $(".deposit_group li").removeClass("active");
            num = $(this).html();
            $("#number").val(num);
            $(this).addClass("active");
            total_money = price * num;
            $("#deposit_form").attr("action", "/agent/deposit")
            $(".deposit_money").html("总价格:" + total_money + "元");
        });

        $(".deposit_group li").click(function () {
            $(".deposit_num li").removeClass("active");
            $(".deposit_group li").removeClass("active");
            $(this).addClass("active");
            $("#number").val("");
            $("#deposit_form").attr("action", "/agent/promote")
            total_money = $(this).attr("value");
            $(".deposit_money").html("总价格:" + total_money + "元");
        });
    </script>


</body>
</html>