<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float: none;">
        <div class="mdui-text-center">
            <h4 class="mdui-typo-display-2-opacity"><?php echo $title; ?></h4>
            <p><?php echo $title; ?></p>
        </div>
    </div>
</div>

<?php view::end('content'); ?>