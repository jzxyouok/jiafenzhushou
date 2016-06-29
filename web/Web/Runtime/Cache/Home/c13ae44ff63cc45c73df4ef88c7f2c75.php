<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>加粉助手</title>
    <meta name="keywords" content="考研帮,考研app,考研应用"/>
    <meta name="description"
          content="考研帮，考研帮（kaoyan.com）倾力打造的手机APP应用，集院校资讯、考研经验、考研资料、考研论坛于一体的考研人的掌上家园！快下载考研帮，考研信息尽在掌握之中。"/>
    <link href="/Public/Home/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css"/>

    
    <link href="/Public/Home/css/news.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<!--header start-->
<div id="header">
    <div class="area clear">
        <a href="http://www.jiafenzhushou.com/" title="加粉助手" class="logo">
            <img src="/Public/Home/images/logo.jpg" alt="加粉助手"/></a>
        <ul class="nav">
            <li><a href="/" title="考研帮">首页</a></li>
            <li><a href="/apps" title="老师版">软件下载</a></li>
            <li><a href="/buy" title="研招网">在线购买</a></li>
            <li><a href="/agent" title="代理合作">代理合作</a></li>
            <li><a href="/news" title="微商教程">微商教程</a></li>
            <li><a href="/contact" title="联系我们">联系我们</a></li>
        </ul>
    </div>
</div>



    <div class="main">
        <div class="main-content">
            <div class="left">
                <div class="news-list">
                    <ul class="news-ul">

                        <?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                                <div class="inner_li">
                                    <div class="img_box">
                                        <a href="/news/<?php echo ($item["news_id"]); ?>">
                                            <img src="<?php echo ($item["thumb"]); ?>">
                                        </a>
                                    </div>
                                    <div class="intro">
                                        <h3>
                                            <a href="/news/<?php echo ($item["news_id"]); ?>"><?php echo ($item["title"]); ?></a>
                                        </h3>
                                        <div class="abstract"><?php echo ($item["description"]); ?></div>
                                    </div>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                </div>

                <div class="loading_more">获得更多</div>
            </div>
            <div class="right">
                <div class="down_load_right">
                    <div class="inner_box">
                        <a class="ios"
                           href="#"
                           target="_blank">iOS版下载</a>
                        <a class="android" href="#" target="_blank"
                           d>Android下载</a>
                    </div>

                </div>
                <div class="qrcode">

                    <img src="/Public/Home/images/qrcode.png">
                </div>
                <div class="contact_title">
                    在线咨询
                </div>
                <div class="contact_qq">
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2462295667&site=qq&menu=yes">QQ在线咨询</a>
                </div>
                <div class="qqgroup_title">
                    QQ群
                </div>
                <div class="contact_qqgroup">

                    <a target="_blank"
                       href="http://shang.qq.com/wpa/qunwpa?idkey=389a2c225a3ee37afe868d1dcd73137fd19e2d1251561f941757cd9bb1f62667">1群</a>
                    <a target="_blank"
                       href="http://shang.qq.com/wpa/qunwpa?idkey=bd33231eabaada873c6105e0a3a88fb66712f577b65b558438b3c47ff298c2c5">2群</a>
                    <a target="_blank"
                       href="http://shang.qq.com/wpa/qunwpa?idkey=ba0b0eb4a955e985865d2e72cd42bd2fe6fa6afdb076f6baf57b253eba05d262">3群</a>
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
        page = 0;
        $(".loading_more").click(function () {
            page = page + 1;
            $(".loading_more").html("加载中...")
            $.get('index.php?m=Home&c=News&a=loadmore', {page: page}).success(
                    function (items) {
                        $.each(items, function (i, val) {
                            var item = '<li>' +
                                    ' <div class="inner_li">' +
                                    ' <div class="img_box">' +
                                    ' <a href="/news/' + val.news_id + '">' +
                                    ' <img src="' + val.thumb + '">' +
                                    ' </a>' +
                                    '</div>' +
                                    '<div class="intro">' +
                                    ' <h3>' +
                                    '  <a href="/news/' + val.news_id + '">' + val.title + '</a>' +
                                    ' </h3>' +
                                    ' <div class="abstract">' + val.description + '</div>' +
                                    ' </div>' +
                                    '</div>' +
                                    '</li>';

                            $(".news-ul").append(item);
                        });
                        $(".loading_more").html("获取更多")
                    });

        });

    </script>


</body>
</html>