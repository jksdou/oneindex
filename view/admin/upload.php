<?php view::layout('layout') ?>
<?php view::begin('content'); ?>
<div class="mdui-container-fluid">

    <div class="mdui-typo">
        <h1>网站上传<small> 网站文件(夹)上传至OneDrive</small></h1>
    </div>

    <form action="" method="post">
        <div class="mdui-row">
            <div class="mdui-col-sm-7 mdui-col-xs-7">
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">网站目录下的文件(夹)</label>
                    <input name="local" class="mdui-textfield-input" type="text" />
                </div>
            </div>
            <div class="mdui-col-sm-3 mdui-col-xs-5">
                <div class="mdui-textfield">
                    <label class="mdui-textfield-label">OneDrive 目录</label>
                    <input name="remote" class="mdui-textfield-input" type="text" value="/site_upload/" />
                </div>
            </div>
            <div class="mdui-col-sm-2 mdui-col-xs-12" style="padding-top: 34px;">
                <button type="submit" name="upload" value="1" class="mdui-btn mdui-btn-block mdui-color-green-600 mdui-ripple">
                    <i class="mdui-icon material-icons">cloud_upload</i> 上传
                </button>
            </div>
        </div>
    </form>
    <br>
</div>

<div class="mdui-container-fluid">
    <div class="mdui-typo">
        <h5>上传进度</h5>
    </div>
    <div class="mdui-table-fluid">
        <table class="mdui-table">
            <thead>
                <tr>
                    <th>远程路径</th>
                    <th>上传速度</th>
                    <th>进度</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="post">
                    <?php foreach ((array)$uploading as $i => $task) : ?>
                        <tr>
                            <td><?php echo $task['remotepath']; ?></td>
                            <td><?php echo onedrive::human_filesize($task['speed']) . '/s'; ?></td>
                            <td><?php echo @floor($task['offset'] / $task['filesize'] * 100) . '%'; ?></td>
                            <?php if ($task['update_time'] == 0) : ?>
                                <td>
                                    等待上传中
                                </td>
                                <td>
                                    <button name="begin_task" class="mdui-btn mdui-color-green-600 mdui-ripple" type="submit" name="remotepath" value="<?php echo $task['remotepath']; ?>">上传</button>
                                </td>
                            <?php elseif (time() > ($task['update_time'] + 60)) : ?>
                                <td>已暂停</td>
                                <td>
                                    <button name="begin_task" class="mdui-btn mdui-color-green-600 mdui-ripple" type="submit" name="remotepath" value="<?php echo $task['remotepath']; ?>">上传</button>
                                </td>
                            <?php else : ?>
                                <td>上传中</td>
                                <td>
                                    <button name="delete_task" class="mdui-btn mdui-color-red mdui-ripple" type="submit" name="remotepath" value="<?php echo $task['remotepath']; ?>">删除</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="mdui-container-fluid">
    <div class="mdui-typo">
        <form action="" method="post" class="mdui-float-right">
            <button name="empty_uploaded" value="1" class="mdui-btn mdui-color-red mdui-ripple" type="submit" name="remotepath">清空已上传记录</button>
        </form>
        <h5>已上传</h5>
    </div>
    <div class="mdui-table-fluid">
        <table class="mdui-table">
            <thead>
                <tr>
                    <th>远程路径</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ((array)$uploaded as $name => $status) : ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php view::end('content'); ?>