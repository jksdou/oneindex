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
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" id="dark_toggle_btn" mdui-tooltip="{content: '切换为亮色模式'}" onclick="darkmode_toggle()">
                <i class="mdui-icon material-icons" id="dark_toggle_icon">brightness_high</i>
            </span>
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-menu="{target: '#admin-menu'}">
                <i class="mdui-icon material-icons">more_vert</i>
            </span>
            <ul id="admin-menu" class="mdui-menu">
                <li class="mdui-menu-item">
                    <a href="<?php echo ROOT_URL_PATH; ?>" class="mdui-ripple" target="_blank"><i class="mdui-icon material-icons">home</i> 首页</a>
                </li>
                <li class="mdui-divider"></li>
                <?php if (is_login()) : ?>
                    <li class="mdui-menu-item">
                        <a href="<?php echo ROOT_URL; ?>admin/setpass" class="mdui-ripple"><i class="mdui-icon material-icons">security</i> 密码修改</a>
                    </li>
                    <li class="mdui-menu-item">
                        <a href="<?php echo ROOT_URL; ?>admin/logout" class="mdui-ripple"><i class="mdui-icon material-icons">exit_to_app</i> 退出登录</a>
                    </li>
                <?php else : ?>
                    <li class="mdui-menu-item">
                        <a href="<?php echo ROOT_URL; ?>admin/login" class="mdui-ripple"><i class="mdui-icon material-icons">account_circle</i> 登录</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <div class="mdui-drawer" id="main-drawer">
        <div class="mdui-text-center mdui-hidden-md-up">
            <p>OneIndex</p>
            <div class="mdui-divider"></div>
        </div>
        <div class="mdui-list">
            <?php if (is_login()) : ?>
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
                    <i class="mdui-list-item-icon mdui-icon material-icons">security</i>
                    <div class="mdui-list-item-content">密码修改</div>
                </a>
                <div class="mdui-divider"></div>
                <a href="<?php echo ROOT_URL; ?>admin/logout" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">exit_to_app</i>
                    <div class="mdui-list-item-content">退出登录</div>
                </a>
            <?php else : ?>
                <a href="<?php echo ROOT_URL_PATH; ?>" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                    <div class="mdui-list-item-content">首页</div>
                </a>
                <div class="mdui-divider"></div>
                <a href="<?php echo ROOT_URL; ?>admin/login" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">account_circle</i>
                    <div class="mdui-list-item-content">登录</div>
                </a>
            <?php endif; ?>

            <div class="mdui-divider"></div>
            <a href="https://onedrive.live.com/" class="mdui-list-item" target="_blank">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">cloud</i>
                <div class="mdui-list-item-content">微软 OneDrive</div>
            </a>
        </div>
    </div>

    <!-- <a id="anchor-top"></a> -->

    <div class="mdui-container">
        <?php view::section('content'); ?>
    </div>

    <div style="height: 20px;"></div>

    <script src="./statics/common/js/darkmode.js"></script>

    <?php if (isset($message) && !empty($message)) : ?>
        <script>
            // 消息提示
            mdui.snackbar({
                position: "right-top",
                message: "<?php echo $message; ?>"
            });
        </script>
    <?php endif; ?>

</body>

</html>