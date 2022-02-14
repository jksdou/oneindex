<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float: none;">
        <div class="mdui-text-center">
            <h4 class="mdui-typo-display-2-opacity">系统管理</h4>
        </div>
        <form action="" method="post">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">https</i>
                <label class="mdui-textfield-label">密码</label>
                <input name="password" class="mdui-textfield-input" type="password" />
            </div>
            <br />
            <button type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-text-color-blue">
                <i class="mdui-icon material-icons">fingerprint</i>
                登录
            </button>
        </form>
    </div>
</div>

<?php view::end('content'); ?>