<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float: none;">
        <div class="mdui-text-center">
            <h4 class="mdui-typo-display-2-opacity"><?php echo $title; ?></h4>
            <p>OneIndex 是一款基于 PHP 的开源免费 OneDrive 文件管理应用</p>
            <p>源码托管在 <a href="https://github.com/doudoudzj/oneindex" target="_blank">GitHub</a></p>
            <h4 class="mdui-typo-display-2-opacity">鸣谢</h4>
            <p>感谢 OneIndex 原作者的开源共享精神</p>
            <p>感谢 Microsoft 提供的 <a href="https://onedrive.live.com" target="_blank" rel="noopener noreferrer">OneDrive</a> 云存储服务</p>
            <p>感谢 <a href="https://staticfile.org" target="_blank">Staticfile CDN</a> 提供免费快速开放的 CDN 服务</p>
            <p>感谢 <a href="https://mdui.org" target="_blank">MDUI</a> 提供的 Material Design User Interface 前端库</p>
        </div>
    </div>
</div>

<?php view::end('content'); ?>
