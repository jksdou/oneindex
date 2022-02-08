<?php view::layout('layout') ?>

<?php view::begin('content'); ?>
<div class="mdui-container-fluid">
    <div class="mdui-typo">
        <h1>密码修改 <small>修改后台管理员登陆密码</small></h1>
    </div>
    <form action="" method="post">
        <div class="mdui-textfield">
            <h4>旧密码</h4>
            <input class="mdui-textfield-input" type="password" name="old_pass" placeholder="请输入旧密码" />
        </div>
        <div class="mdui-textfield">
            <h4>新密码</h4>
            <input class="mdui-textfield-input" type="password" name="password" placeholder="请输入新密码" />
        </div>
        <div class="mdui-textfield">
            <h4>确认新密码</h4>
            <input class="mdui-textfield-input" type="password" name="password2" placeholder="请再次输入新密码" />
        </div>
        <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right">
            <i class="mdui-icon material-icons">save</i> 保存
        </button>
    </form>
</div>
<?php view::end('content'); ?>