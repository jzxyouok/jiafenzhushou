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
    
    <link rel="stylesheet" type="text/css" href="/Public/vendor/parsley/parsley.css" />



</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="/admin.php" class="logo">
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
                <li id="moduleDashboard"><a href="/admin.php"><i class="fa fa-dashboard"></i> <span>主控面板</span></a></li>

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
            管理员
            <small><a href="<?php echo U('Admin/Admin/index');?>">管理员管理</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="<?php echo U('Admin/Admin/index');?>">管理员管理</a></li>
            <li class="active">管理员</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <form action="<?php echo U('');?>" class="form-horizontal" method="POST" enctype="multipart/form-data"
                          novalidate="novalidate">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加管理员</h3>
                            <div class="box-tools">
                                <button type="submit" class="btn btn-sm  btn-primary pull-right">
                                    <i class="fa fa-edit fa-lg"></i> 保存信息
                                </button>
                            </div>
                        </div>

                        <div class="box-body ">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label class="col-sm-3 control-label">名称:</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="username" name="username" class="form-control"
                                               placeholder="管理员名称" required="required"
                                               data-parsley-trigger="blur change"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label class="col-sm-3 control-label">密码:</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="密码" required="required" data-parsley-type="password"
                                               data-parsley-trigger="blur change"/></div>
                                </div>
                            </div>


                        </div>


                    </form>
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

    <script type="text/javascript" src="/Public/vendor/parsley/parsley.min.js"></script>
    <script type="text/javascript" src="/Public/vendor/parsley/i18n/zh_cn.js"></script>
    <script type="text/javascript">
        $(function () {
            $("form").parsley({
                successClass: "has-success",
                errorClass: "has-error",
                classHandler: function (el) {
                    return el.$element.closest(".form-group");
                },
                errorsWrapper: "<span></span>",
                errorTemplate: "<span></span>"
            });
        });

    </script>

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