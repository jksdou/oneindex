<?php view::layout('layout') ?>
<?php
function getPHPExecutableFromPath()
{
    $php_bin = 'php';
    $paths = explode(PATH_SEPARATOR, getenv('PATH'));
    foreach ($paths as $path) {
        if (strstr($path, 'php.exe') && isset($_SERVER["WINDIR"]) && file_exists($path) && is_file($path)) {
            return $path;
        } else {
            $php_executable = $path . DIRECTORY_SEPARATOR . "php" . (isset($_SERVER["WINDIR"]) ? ".exe" : "");
            // if (file_exists($php_executable) && is_file($php_executable)) {
            if ($php_executable) {
                $php_bin = $php_executable;
            } else {
                $php_bin = 'php'; // not found
            }
        }
    }
    return $php_bin;
}
$php_path = getPHPExecutableFromPath();
$script_path = ROOT . 'one.php';
?>
<?php view::begin('content'); ?>
<div class="mdui-container-fluid">

    <div class="mdui-typo">
        <h1>页面缓存 <small>清除所有页面缓存</small></h1>
    </div>
    <br>
    <br>
    <br>
    <div class="mdui-row-xs-2">
        <form action="" method="post">
            <div class="mdui-col">
                <button type="submit" name="clear" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">
                    <i class="mdui-icon material-icons">clear</i> 清除所有缓存
                </button>
            </div>
            <div class="mdui-col">
                <button type="submit" name="refresh" class="mdui-btn mdui-btn-block mdui-color-green-600 mdui-ripple">
                    <i class="mdui-icon material-icons">loop</i> 重建所有缓存
                </button>
            </div>
        </form>
    </div>

    <div class="mdui-typo">
        <h4 class="doc-article-title">crontab定时刷新缓存 <small>能极大提高系统访问性能</small></h4>
        <p>添加以下命令到crontab</p>
        <p><code>*/10 * * * * <?php echo "{$php_path} {$script_path} cache:refresh"; ?></code></p>
    </div>

</div>
<script>
    $('button[name=refresh]').on('click', function() {
        mdui.snackbar({
            position: 'right-top',
            message: '正在重建缓存，请耐心等待...'
        });
    });
</script>
<?php view::end('content'); ?>