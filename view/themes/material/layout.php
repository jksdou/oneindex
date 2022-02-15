<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <title><?php e($title . ' - ' . config('site_name')); ?></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/mdui/0.4.3/css/mdui.min.css">
    <script src="https://cdn.staticfile.org/mdui/0.4.3/js/mdui.min.js"></script>
    <script>
        var $ = mdui.JQ;
    </script>
    <style>
        .file-list-page .mdui-list-item {
            margin: 2px 0px;
            padding: 0;
        }

        .file-list-page .mdui-list-item>a {
            width: 100%;
            line-height: 48px
        }

        .file-list-page .mdui-list>.th {
            background-color: initial
        }

        .file-list-toolbar {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #toolbar-router-menu,
        #toolbar-login-menu {
            margin-top: 50px;
        }

        @media screen and (max-width:980px) {
            .mdui-container {
                width: 100% !important;
                margin: 0px;
            }
        }
    </style>
</head>

<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-teal mdui-theme-accent-blue">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#menu-drawer', swipe: true}">
                <i class="mdui-icon material-icons">menu</i>
            </span>
            <a href="<?php echo ROOT_URL_PATH; ?>" class="mdui-typo-headline"><?php e(config('site_name')); ?></a>

            <?php foreach ((array)$navs as $n => $l) : ?>
                <i class="mdui-icon material-icons mdui-icon-dark mdui-hidden-sm-down" style="margin:0;">chevron_right</i>
                <a href="<?php e($l); ?>" class="mdui-hidden-sm-down"><?php e($n); ?></a>
            <?php endforeach; ?>
            <div class="mdui-toolbar-spacer"></div>
            <!-- mobile -->
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white mdui-hidden-md-up" mdui-menu="{target: '#toolbar-router-menu'}">
                <i class="mdui-icon material-icons">expand_more</i>
            </span>
            <ul id="toolbar-router-menu" class="mdui-menu mdui-hidden-md-up">
                <?php foreach ((array)$navs as $n => $l) : ?>
                    <li class="mdui-menu-item">
                        <a href="<?php e($l); ?>" class="mdui-ripple">
                            <i class="mdui-menu-item-icon mdui-icon material-icons">chevron_right</i><?php e($n); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Github -->
            <a href="https://github.com/doudoudzj/oneindex" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '查看 Github'}">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36 36" enable-background="new 0 0 36 36" xml:space="preserve" class="mdui-icon" style="width: 24px;height:24px;">
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#ffffff" d="M18,1.4C9,1.4,1.7,8.7,1.7,17.7c0,7.2,4.7,13.3,11.1,15.5c0.8,0.1,1.1-0.4,1.1-0.8c0-0.4,0-1.4,0-2.8c-4.5,1-5.5-2.2-5.5-2.2c-0.7-1.9-1.8-2.4-1.8-2.4c-1.5-1,0.1-1,0.1-1c1.6,0.1,2.5,1.7,2.5,1.7c1.5,2.5,3.8,1.8,4.7,1.4c0.1-1.1,0.6-1.8,1-2.2c-3.6-0.4-7.4-1.8-7.4-8.1c0-1.8,0.6-3.2,1.7-4.4c-0.2-0.4-0.7-2.1,0.2-4.3c0,0,1.4-0.4,4.5,1.7c1.3-0.4,2.7-0.5,4.1-0.5c1.4,0,2.8,0.2,4.1,0.5c3.1-2.1,4.5-1.7,4.5-1.7c0.9,2.2,0.3,3.9,0.2,4.3c1,1.1,1.7,2.6,1.7,4.4c0,6.3-3.8,7.6-7.4,8c0.6,0.5,1.1,1.5,1.1,3c0,2.2,0,3.9,0,4.5c0,0.4,0.3,0.9,1.1,0.8c6.5-2.2,11.1-8.3,11.1-15.5C34.3,8.7,27,1.4,18,1.4z"></path>
                </svg>
            </a>
            <!-- darkmode -->
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" id="dark_toggle_btn" mdui-tooltip="{content: '切换为亮色模式'}" onclick="darkmode_toggle()">
                <i class="mdui-icon material-icons" id="dark_toggle_icon">brightness_high</i>
            </span>
            <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-menu="{target: '#toolbar-login-menu'}">
                <i class="mdui-icon material-icons">more_vert</i>
            </span>
            <ul id="toolbar-login-menu" class="mdui-menu">
                <li class="mdui-menu-item">
                    <a href="<?php echo ROOT_URL_PATH; ?>" class="mdui-ripple"><i class="mdui-menu-item-icon mdui-icon material-icons">home</i> 首页</a>
                </li>
                <li class="mdui-divider"></li>
                <?php if (is_login()) : ?>
                    <li class="mdui-menu-item">
                        <a href="<?php echo ROOT_URL; ?>admin/logout" class="mdui-ripple"><i class="mdui-menu-item-icon mdui-icon material-icons">exit_to_app</i> 退出登录</a>
                    </li>
                <?php else : ?>
                    <li class="mdui-menu-item">
                        <a href="<?php echo ROOT_URL; ?>admin/login" class="mdui-ripple"><i class="mdui-menu-item-icon mdui-icon material-icons">account_circle</i> 登录</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <div class="mdui-drawer" id="menu-drawer">
        <div class="mdui-text-center mdui-hidden-md-up">
            <p><?php e(config('site_name')); ?></p>
            <div class="mdui-divider"></div>
        </div>
        <div class="mdui-list">
            <?php if (is_login() || is_images_public()) : ?>
                <a href="<?php echo ROOT_URL; ?>user/images" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">photo</i>
                    <div class="mdui-list-item-content">图床</div>
                </a>
            <?php endif; ?>
            <?php if (is_login()) : ?>
                <a href="<?php echo ROOT_URL; ?>offline" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">cloud_upload</i>
                    <div class="mdui-list-item-content">离线下载</div>
                </a>
                <div class="mdui-divider"></div>
                <a href="<?php echo ROOT_URL; ?>admin/logout" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">exit_to_app</i>
                    <div class="mdui-list-item-content">退出登录</div>
                </a>
            <?php else : ?>
                <a href="<?php echo ROOT_URL; ?>admin/login" class="mdui-list-item">
                    <i class="mdui-list-item-icon mdui-icon material-icons">account_circle</i>
                    <div class="mdui-list-item-content">登录</div>
                </a>
            <?php endif; ?>
            <div class="mdui-divider"></div>
            <a href="https://onedrive.live.com/" class="mdui-list-item" target="_blank">
                <i class="mdui-list-item-icon mdui-icon material-icons">cloud</i>
                <div class="mdui-list-item-content">登陆 OneDrive</div>
            </a>
            <a href="https://store.lizhi.io/site/products/id/65?cid=ji6bagm9" class="mdui-list-item" target="_blank">
                <i class="mdui-list-item-icon mdui-icon material-icons">shopping_cart</i>
                <div class="mdui-list-item-content">Microsoft 365</div>
            </a>
        </div>
    </div>

    <div class="mdui-container">
        <?php view::section('content'); ?>
    </div>
    <script src="./statics/common/js/darkmode.js"></script>
</body>

</html>