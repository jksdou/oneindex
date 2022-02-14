<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float:none;">
        <center>
            <h4 class="mdui-typo-display-2-opacity">用户登录</h4>
        </center>
        <form action="" method="post">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">https</i>
                <label class="mdui-textfield-label">密码</label>
                <input name="password" class="mdui-textfield-input" type="password" />
            </div>
            <br>
            <button type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme">
                <i class="mdui-icon material-icons">fingerprint</i>
                登录
            </button>
        </form>
    </div>

</div>

<?php view::end('content'); ?>