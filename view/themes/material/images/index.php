<?php view::layout('layout') ?>

<?php view::begin('content'); ?>

<div class="mdui-container-fluid">
    <div class="mdui-col-md-6 mdui-col-sm-6 mdui-center" style="float: none;">
        <div class="mdui-text-center">
            <h4 class="mdui-typo-display-3-opacity">Images</h4>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="mdui-center" type="file" style="margin: 50px 0;" name="file" />
            <div class="mdui-row-xs-3">
                <div class="mdui-col"></div>
                <div class="mdui-col">
                    <button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">上传</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php view::end('content'); ?>