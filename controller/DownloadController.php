<?php
class DownloadController
{
    private $url_path;
    private $name;
    private $path;
    private $items;

    function __construct()
    {
        // 获取路径和文件名
        $paths = explode('/', rawurldecode($_GET['path']));
        if (substr($_SERVER['REQUEST_URI'], -1) != '/') {
            $this->name = array_pop($paths);
        }
        $this->url_path = get_absolute_path(join('/', $paths));
        $this->path = get_absolute_path(config('onedrive_root') . $this->url_path);
        // 获取文件夹下所有元素
        $this->items = $this->items($this->path);
    }

    function index()
    {
        // 是否404
        $this->is404();

        $this->is_password();

        header("Expires:-1");
        header("Cache-Control:no_cache");
        header("Pragma:no-cache");

        if (!empty($this->name)) { // file
            header('Location: ' . $this->items[$this->name]['downloadUrl']);
        } else { // dir
            http_response_code(404);
            view::load('404')->show();
            die();
        }
    }

    // 判断是否加密
    function is_password()
    {
        if (empty($this->items['.password'])) {
            return false;
        }

        $this->items['.password']['path'] = get_absolute_path($this->path) . '.password';

        $password = $this->get_content($this->items['.password']);
        list($password) = explode("\n", $password);
        $password = trim($password);
        unset($this->items['.password']);
        if (!empty($password) && strcmp($password, $_COOKIE[md5($this->path)]) === 0 || is_login()) {
            return true;
        }

        $this->password($password);
    }

    function password($password)
    {
        if (!empty($_POST['password']) && strcmp($password, $_POST['password']) === 0) {
            setcookie(md5($this->path), $_POST['password']);
            return true;
        }
        $navs = $this->navs();
        echo view::load('password')->with('navs', $navs);
        exit();
    }

    // 文件夹下元素
    function items($path, $fetch = false)
    {
        $items = cache::get('dir_' . $this->path, function () {
            return onedrive::dir($this->path);
        }, config('cache_expire_time'));
        return $items;
    }

    function navs()
    {
        $navs['/'] = get_absolute_path(ROOT_URL . 'files/');
        foreach (explode('/', $this->url_path) as $v) {
            if (empty($v)) {
                continue;
            }
            $navs[rawurldecode($v)] = end($navs) . $v . '/';
        }
        if (!empty($this->name)) {
            $navs[$this->name] = end($navs) . urlencode($this->name);
        }

        return $navs;
    }

    static function get_content($item)
    {
        $content = cache::get('content_' . $item['path'], function () use ($item) {
            $resp = fetch::get($item['downloadUrl']);
            if ($resp->http_code == 200) {
                return $resp->content;
            }
        }, config('cache_expire_time'));
        return $content;
    }

    // 是否 404
    function is404()
    {
        if (!empty($this->items[$this->name]) || (empty($this->name) && is_array($this->items))) {
            return false;
        }

        http_response_code(404);
        view::load('404')->show();
        die();
    }

    function __destruct()
    {
        if (!function_exists("fastcgi_finish_request")) {
            return;
        }
    }
}
