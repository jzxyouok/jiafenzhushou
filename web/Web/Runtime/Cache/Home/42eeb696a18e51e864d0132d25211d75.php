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

    
    <link href="/Public/Home/css/agent.css" rel="stylesheet" type="text/css"/>

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
            <div class="aside">
                <ul class="agent-nav">
                    <li class="menu-item">
                        <a href="/agent">主控面板</a>
                    </li>
                    <li class="menu-item">
                        <a href="/agent/orders">购买记录</a>
                    </li>
                    <li class="menu-item active">
                        <a href="/agent/deposits">充值记录</a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="box">
                    <table class="datatable">
                        <thead>
                        <tr role="row">
                            <th rowspan="1"
                                colspan="1">
                                金额
                            </th>

                            <th rowspan="1"
                                colspan="1"
                            >激活码数量
                            </th>
                            <th rowspan="1"
                                colspan="1"
                            >充值时间
                            </th>


                        </tr>
                        </thead>

                        <tbody>

                        <?php if(empty($_list)): ?><tr>
                                <td colspan="3">没有记录</td>
                            </tr>
                            <?php else: ?>

                            <?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                                    <td rowspan="1"
                                        colspan="1"
                                    ><?php echo ($item["money"]); ?>
                                    </td>
                                    <td rowspan="1"
                                        colspan="1"
                                    ><?php echo ($item["codes"]); ?>
                                    </td>
                                    <td rowspan="1"
                                        colspan="1"
                                    ><?php echo date('Y-m-d
                                        H:i:s',$item['create_time']);?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>


                        </tbody>
                    </table>
                </div>
                <div> <?php echo ($_page); ?></div>
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




</body>
</html>