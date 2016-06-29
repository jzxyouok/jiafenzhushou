<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 8]>
<html lang="zh-CN" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html lang="zh-CN" class="no-js lt-ie10 lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="zh-CN" class="no-js lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="zh-CN" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/adminlte/dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/toastr/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/adminlte/dist/css/skins/_all-skins.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/fontawesome/css/font-awesome-ie7.css" />
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/Admin/vendor/html5shiv/dist/html5shiv.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/vendor/respond/dest/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/datatables/dataTables.bootstrap.css" />



</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="/manage.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>管</b>理</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>管理</b>系统</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="<?php echo U('Admin/Logout/index');?>">
                            <img src="/Public/Admin/image/admin.jpg" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">注销</span>
                        </a>

                    </li>

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/Public/Admin/image/admin.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $currentUser['real_name'] ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i><?php echo session('admin.username');?> </a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">功能菜单导航</li>
                <li id="moduleDashboard"><a href="/manage.php"><i class="fa fa-dashboard"></i> <span>主控面板</span></a></li>

                <li class="header">文章管理</li>
                <li>
                    <a href="<?php echo U('Admin/News/index');?>">
                        <i class="fa fa-database"></i>
                        <span>文章管理</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                </li>

                <li class="header">充值管理</li>
                <li>
                    <a href="<?php echo U('Admin/Deposit/index');?>">
                        <i class="fa fa-rmb"></i>
                        <span>充值管理</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                </li>


                <li class="header">财务管理</li>
                <li>
                    <a href="<?php echo U('Admin/Order/index');?>">
                        <i class="fa fa-exchange"></i>
                        <span>订单管理</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                </li>


                <li class="header">会员管理</li>
                <li>
                    <a href="<?php echo U('Admin/User/index');?>">
                        <i class="fa fa-user"></i>
                        <span>会员管理</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                </li>


                <li class="header">系统管理设置</li>

                <li id="moduleAdmin">
                    <a href="<?php echo U('Admin/Admin/index');?>">
                        <i class="fa fa-circle-o text-yellow"></i>
                        <span>管理员管理</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>

                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height:1000px">
        
    <section class="content-header">
        <h1>
            用户
            <small><a href="<?php echo U('Admin/User/index');?>">用户管理</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="<?php echo U('Admin/User/index');?>">用户管理</a></li>
            <li class="active">用户</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">用户列表</h3>

                        <div class="box-tools">
                            <form action="/manage.php?m=Admin&c=User&a=index" method="POST">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input name="mobile" type="text" class="form-control pull-right" value="<?php echo I('mobile');?>" placeholder="关键词">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!--<i class=""></i>-->
                        <!--<a href="<?php echo U('Admin/User/add');?>">-->
                            <!--<i class="fa fa-plus-circle"></i> 添加用户-->
                        <!--</a>-->

                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="list" class="table table-bordered table-striped dataTable" role="grid"
                                           aria-describedby="list_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_desc" tabindex="0" aria-controls="list" rowspan="1"
                                                colspan="1"
                                                style="width: 163px;" aria-sort="descending">ID
                                            </th>
                                            <th tabindex="0" rowspan="1"
                                                colspan="1"
                                                style="width: 203px;">
                                                名称
                                            </th>

                                            <th tabindex="0" rowspan="1"
                                                colspan="1"
                                                style="width: 203px;">
                                                分组
                                            </th>


                                            <th rowspan="1"
                                                colspan="1"

                                                style="width: 140px;">状态
                                            </th>
                                            <th rowspan="1"
                                                colspan="1"

                                                style="width: 101px;">
                                                操作
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $group=array('普通用户','授权分销商','特约经销商') ?>
                                        <?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr role="row" class="  <?php if(($mod) == "2"): ?>odd<?php else: ?>even<?php endif; ?>">
                                                <td><?php echo ($item["user_id"]); ?></td>
                                                <td><?php echo ($item["nickname"]); ?></td>
                                                <td><?php echo ($group[$item['user_group']-1]); ?></td>
                                                <td><?php $status = array( '-1' => 'label-danger', '0' => 'label-warning', '1' => 'label-success', ); $statusText = array( '-1' => '已删除', '0' => '未激活', '1' => '活跃中', ); ?>
                                                <span
                                                        class="label label-sm  <?php echo ($status[$item['status']]); ?>"><?php echo ($statusText[$item['status']]); ?></span>
                                                </td>
                                                <td>

                                                    <?php if(($item["status"]) == "1"): ?><a href="<?php echo U('Admin/User/changeStatus?method=forbid&user_id='.$item['user_id']);?>"
                                                           class="table-link text-yellow ajax-get">
                                                        <span class="fa-stack">
											            <i class="fa fa-square fa-stack-2x "></i>
                                                            <i class="fa   fa-power-off fa-stack-1x fa-inverse "></i>
									                    </span>
                                                        </a>
                                                        <?php else: ?>
                                                        <a href="<?php echo U('Admin/User/changeStatus?method=resume&user_id='.$item['user_id']);?>"
                                                           class="ajax-get text-green table-link">
                                                        <span class="fa-stack">
											            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa  fa-check-circle-o fa-stack-1x fa-inverse"></i>
									                    </span>
                                                        </a><?php endif; ?>
                                                    <a href="<?php echo U('Admin/User/edit?&user_id='.$item['user_id']);?>"
                                                       class="table-link">
                                                    <span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
									                </span>
                                                    </a>
                                                    <a href="<?php echo U('Admin/User/changeStatus?method=delete&user_id='.$item['user_id']);?>"
                                                       class="table-link text-red confirm ajax-get">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square  fa-stack-2x"></i>
											            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
									            </span>
                                                    </a>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>


                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">

                                </div>
                                <div class="col-sm-7">
                                   <div><?php echo ($_page); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="http://www.weibo.com/kaozuo">Rocks</a>.</strong> All rights
        reserved.
    </footer>


</div>
<!-- ./wrapper -->


<script type="text/javascript" src="/Public/Admin/vendor/jQuery/jQuery-2.2.0.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/fastclick/fastclick.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/adminlte/dist/js/app.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/toastr/toastr.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/adminlte/dist/js/demo.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/zeroclipboard/ZeroClipboard.min.js"></script>

    <script type="text/javascript" src="/Public/Admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/vendor/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var CONTROLLER_NAME = "<?php echo CONTROLLER_NAME; ?>";
        $("#controller" + CONTROLLER_NAME).parents(".treeview").addClass('active');
        $("#controller" + CONTROLLER_NAME).addClass('active');
        initCopy();
    });

    function initCopy() {
        var client = new ZeroClipboard($(".copy-data"));
        client.on("ready", function (readyEvent) {
            // alert( "ZeroClipboard SWF is ready!" );
            client.on("aftercopy", function (event) {
                op_success("复制成功");
            });

        });

    }
</script>
</body>
</html>