<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <title>OneIndex 系统管理</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/mdui/0.4.3/css/mdui.min.css">
    <script src="https://cdn.staticfile.org/mdui/0.4.3/js/mdui.min.js"></script>
    <script>
        $ = mdui.JQ;
    </script>
</head>

<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-blue">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer', swipe: true}">
                <i class="mdui-icon material-icons">menu</i>
            </span>
            <a href="<?php echo ROOT_URL; ?>admin" class="mdui-typo-headline mdui-hidden-xs">OneIndex</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="<?php echo ROOT_URL_PATH; ?>" target="_blank">首页</a>
            <a href="<?php echo ROOT_URL; ?>admin/logout"><i class="mdui-icon material-icons">power_settings_new</i> 登出</a>
        </div>
    </header>
    <div class="mdui-drawer" id="main-drawer">
        <div class="mdui-text-center mdui-hidden-md-up">
            <p>OneIndex</p>
            <div class="mdui-divider"></div>
        </div>
        <div class="mdui-list">
            <a href="<?php echo ROOT_URL; ?>admin/" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-green">home</i>
                <div class="mdui-list-item-content">后台首页</div>
            </a>
            <a href="<?php echo ROOT_URL; ?>admin" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">settings</i>
                <div class="mdui-list-item-content">基本设置</div>
            </a>

            <a href="<?php echo ROOT_URL; ?>admin/cache" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">layers</i>
                <div class="mdui-list-item-content">页面缓存</div>
            </a>

            <a href="<?php echo ROOT_URL; ?>admin/show" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">blur_on</i>
                <div class="mdui-list-item-content">文件展示设置</div>
            </a>
            <a href="<?php echo ROOT_URL; ?>admin/images" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">photo</i>
                <div class="mdui-list-item-content">图床设置</div>
            </a>

            <a href="<?php echo ROOT_URL; ?>admin/upload" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">file_upload</i>
                <div class="mdui-list-item-content">网站上传</div>
            </a>

            <a href="<?php echo ROOT_URL; ?>admin/offline" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">cloud_upload</i>
                <div class="mdui-list-item-content">上传设置</div>
            </a>

            <a href="<?php echo ROOT_URL; ?>admin/setpass" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">https</i>
                <div class="mdui-list-item-content">密码修改</div>
            </a>

            <a href="https://onedrive.live.com/" class="mdui-list-item" target="_blank">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">cloud</i>
                <div class="mdui-list-item-content">OneDrive</div>
            </a>

            <div class="mdui-divider"></div>

            <a href="<?php echo ROOT_URL; ?>admin/logout" class="mdui-list-item">
                <i class="mdui-list-item-icon mdui-icon material-icons">power_settings_new</i>
                <div class="mdui-list-item-content">退出登录</div>
            </a>
        </div>
    </div>

    <a id="anchor-top"></a>

    <div class="mdui-container">
        <?php view::section('content'); ?>
    </div>
    <div style="height: 20px;"></div>
    <script>
        $("a[href='<?php echo '?' . (route::get_uri()); ?>']").addClass("mdui-text-color-blue");
        // 消息提示
        <?php echo (isset($message) && !empty($message)) ? "mdui.snackbar({position: 'right-top', message: '{$message}'});" : ''; ?>
    </script>
</body>

</html>