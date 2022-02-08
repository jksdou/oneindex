<?php view::layout('layout') ?>

<?php view::begin('content'); ?>
<div class="mdui-container-fluid">
    <div class="mdui-typo">
        <h1> 基本设置 <small>设置基本参数</small></h1>
    </div>
    <form action="" method="post">
        <div class="mdui-textfield">
            <h4>网站名称</h4>
            <input class="mdui-textfield-input" type="text" name="site_name" value="<?php echo $config['site_name']; ?>" placeholder="网站名称" />
        </div>

        <div class="mdui-textfield" style="overflow: unset;">
            <h4>网站主题</h4>
            <select name="style" class="mdui-select" mdui-select>
                <?php
                foreach (scandir(ROOT . '/view/themes') as $k => $s) {
                    $styles[$k] = trim($s, '/');
                }
                $styles = array_diff($styles, ['.', '..', 'admin', '.DS_Store']);
                $style = config('style') ? config('style') : 'nexmoe';
                $cache_type  = config('cache_type') ? config('cache_type') : 'secache';
                foreach ($styles as $style_name) :
                ?>
                    <option value="<?php echo $style_name; ?>" <?php echo ($style == $style_name) ? 'selected' : ''; ?>><?php echo $style_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mdui-textfield">
            <h4>OneDrive起始目录(空为根目录)<small>例：仅共享share目录 /share</small></h4>
            <input class="mdui-textfield-input" type="text" name="onedrive_root" value="<?php echo $config['onedrive_root']; ?>" />
        </div>

        <div class="mdui-textfield">
            <h4>不渲染目录</h4>
            <input class="mdui-textfield-input" type="text" name="except_path" value="<?php echo $config['except_path']; ?>" placeholder="不渲染目录" />
            <div class="mdui-textfield-helper">设置所有目录都不渲染输入all，设置名为all的目录不渲染，输入/all</div>
        </div>

        <div class="mdui-textfield">
            <h4>需要隐藏的目录</h4>
            <textarea class="mdui-textfield-input" placeholder="输入后回车换行" name="onedrive_hide"><?= @$config['onedrive_hide']; ?></textarea>
            <div class="mdui-textfield-helper">这里是通配识别，就是存在以上字符文件夹一律会隐藏，不需要列出的目录(一行一个) 清空缓存后生效</div>
        </div>

        <div class="mdui-textfield">
            <h4>防盗链(域名白名单)</h4>
            <input class="mdui-textfield-input" name="onedrive_hotlink" value="<?= @$config['onedrive_hotlink']; ?>" placeholder="设置域名白名单" />
            <div class="mdui-textfield-helper">不填写则不启用, 多个用英文 <code>;</code> 分割，支持通配符 例: <code>*.domain.com</code></div>
        </div>

        <div class="mdui-textfield" style="overflow: unset;">
            <h4>缓存类型</h4>
            <select name="cache_type" class="mdui-select" mdui-select>
                <?php foreach (['secache', 'filecache', 'memcache', 'redis'] as $type) : ?>
                    <option value="<?php echo $type; ?>" <?php echo ($type == $cache_type) ? 'selected' : ''; ?>><?php echo $type; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mdui-textfield">
            <h4>缓存过期时间(秒)</h4>
            <input class="mdui-textfield-input" type="text" name="cache_expire_time" value="<?php echo $config['cache_expire_time']; ?>" placeholder="缓存过期时间" />
        </div>

        <div class="mdui-textfield">
            <h4>去掉地址栏中的<code style="color: #c7254e;background-color: #f7f7f9;font-size:16px;">/?/</code> (需配合伪静态使用!!)</h4>
            <label class="mdui-textfield-label"></label>
            <label class="mdui-switch">
                <input type="checkbox" name="root_path" value="?" <?php echo empty($config['root_path']) ? 'checked' : ''; ?> />
                <i class="mdui-switch-icon"></i>
            </label>
        </div>

        <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right">
            <i class="mdui-icon material-icons">save</i> 保存
        </button>
    </form>
</div>
<?php view::end('content'); ?>