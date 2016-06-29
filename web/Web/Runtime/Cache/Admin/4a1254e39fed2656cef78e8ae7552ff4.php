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
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/adminlte/dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/parsley/parsley.css" />


    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/vendor/fontawesome/css/font-awesome-ie7.css" />
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/Admin/vendor/html5shiv/dist/html5shiv.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/vendor/respond/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">

<!-- /.login-logo -->
<div class="login-box">
    <div class="login-logo">
        <b>管理系统</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p id="login-box-msg" class="login-box-msg text-danger"></p>
        <form id="form" action="<?php echo U();?>" method="post" novalidate="novalidate">
            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" placeholder="用户名" class="form-control"
                       required="required"
                       data-parsley-trigger="blur change"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" placeholder="密码" name="password" class="form-control"
                       required="required"
                       data-parsley-trigger="blur change" data-parsley-minlength="6" data-parsley-maxlength="16"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="check-tips">
            </div>
            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script type="text/javascript" src="/Public/Admin/vendor/jQuery/jQuery-2.2.0.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/parsley/parsley.min.js"></script>
<script type="text/javascript" src="/Public/Admin/vendor/parsley/i18n/zh_cn.js"></script>
;

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

    $(document).ajaxStart(function () {
        $("button:submit").addClass("disabled").attr("disabled", true);
    }).ajaxStop(function () {
        $("button:submit").removeClass("disabled").attr("disabled", false);
    });

    $("form").submit(function () {
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data) {
            if (data.status) {
                window.location.href = data.url;
            } else {
                $(".login-box-msg").html(data.message);
            }
        }
    });


</script>

</body>
</html>