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

    
    <link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Home/Vendor/swiper/swiper.css" rel="stylesheet" type="text/css"/>

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



    <div class="slider">
        <!--滚屏 start-->
        <div class="swiper-container" id="swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide contentOne" id="content_1">
                    <div class="area">
                        根据您报考的院校 , 专业!推送精准消息，you can make it</div>
                </div>
                <div class="swiper-slide contentTwo" id="content_2">
                    <div class="area">
                        根据您报考的院校 , 专业。推送精准消息</div>
                </div>
                <div class="swiper-slide contentThr" id="content_3">
                    <div class="area">
                        考研人的精神家园,考研论坛</div>
                </div>

            </div>
        </div>

        <!--滚屏 end-->
        <div class="floatWx">
            <div class="floatWxCon">
                <img src="/Public/Home/images/qrcode.png" class="wxImg">
                <p class="wxWords">
                    手机扫描二维码下载</p>
                <a href="http://fir.im/jfzs" class="androidBtn">Android下载</a> <a href="http://fir.im/lbpf" class="appstoreBtn">IOS下载</a>
            </div>
            <p class="floatWxBg">
            </p>
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
                           href="http://fir.im/lbpf"
                           target="_blank">iOS版下载</a>
                        <a class="android" href="http://fir.im/jfzs" target="_blank"
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


    <script src="/Public/Home/js/jquery-2.2.4.min.js"></script>
    <script src="/Public/Home/Vendor/swiper/swiper.min.js"></script>
    <script type="text/javascript">

        var mySwiper = new Swiper('#swiper-container',{
            mode: 'vertical',
            autoplay : 4000,
            loop:true,

        })


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