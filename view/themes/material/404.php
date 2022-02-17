<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-text-center">
    <h4 class="mdui-typo-display-2-opacity">文件不存在</h4>
    <p style="margin-bottom: 50px;">抱歉！您访问的文件不存在。</p>
    <a href="<?php echo ROOT_URL_PATH; ?>files/" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme">
        <i class="mdui-icon material-icons">home</i>
        回首页
    </a>
</div>

<?php view::end('content'); ?>