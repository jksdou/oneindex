<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float: none;">
        <div class="mdui-text-center">
            <h1 class="mdui-typo-display-3-opacity">OneIndex</h1>
            <p style="margin-bottom: 50px;">Onedrive Directory Index</p>
            <div class="actions">
                <p><a href="<?php echo ROOT_URL_PATH; ?>files/" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme">查看文件</a></p>
                <p><a href="<?php echo ROOT_URL_PATH; ?>about" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme">关于 OneIndex</a></p>
                <p><a href="https://github.com/doudoudzj/oneindex" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme" target="_blank">Github</a></p>
            </div>
        </div>
    </div>
</div>

<?php view::end('content'); ?>