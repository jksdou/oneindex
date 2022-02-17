<?php view::layout('files/layout') ?>
<?php
function code_type($ext)
{
    $code_type['xhtml'] = 'xml';
    $code_type['html'] = 'xml';
    $code_type['htm'] = 'xml';
    $code_type['css'] = 'css';
    $code_type['js'] = 'javascript';
    $code_type['ts'] = 'typescript';
    $code_type['json'] = 'json';
    $code_type['php'] = 'php';
    $code_type['c'] = 'cpp';
    $code_type['h'] = 'cpp';
    $code_type['cpp'] = 'cpp';
    $code_type['java'] = 'java';
    $code_type['go'] = 'go';
    $code_type['sql'] = 'sql';
    $code_type['ini'] = 'ini';
    $code_type['py'] = 'python';
    $code_type['editorconfig'] = 'ini';
    $code_type['prettierrc'] = 'json';
    $code_type['eslintrc'] = 'json';
    $code_type['txt'] = 'plaintext';
    $code_type['env'] = 'plaintext';
    $code_type['gitignore'] = 'plaintext';
    $code_type['sh'] = 'bash';
    $code_type['md'] = 'markdown';

    return @$code_type[$ext];
}

$language = code_type($ext);

$content = FilesController::get_content($item);
?>
<?php view::begin('content'); ?>
<!-- <link rel="stylesheet" href="https://cdn.staticfile.org/highlight.js/11.4.0/styles/dark.min.css"> -->
<link rel="stylesheet" href="https://cdn.staticfile.org/highlight.js/11.4.0/styles/default.min.css">

<div class="mdui-container-fluid">
    <pre><code class="language-<?php e($language); ?>"><?php echo htmlentities($content); ?></code></pre>
    <div class="mdui-divider"></div>
    <div class="mdui-textfield">
        <label class="mdui-textfield-label">下载地址</label>
        <input class="mdui-textfield-input" type="text" value="<?php e($url); ?>" />
    </div>

    <a href="<?php e($url); ?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent">
        <i class="mdui-icon material-icons">file_download</i>
    </a>
</div>

<div style="height: 50px;"></div>

<script src="https://cdn.staticfile.org/highlight.js/11.4.0/highlight.min.js"></script>
<script>
    hljs.highlightAll();
</script>

<?php view::end('content'); ?>