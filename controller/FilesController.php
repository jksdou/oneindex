<?php
class FilesController
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

        if (!empty($this->name)) { //file
            return $this->file_handler();
        } else { //dir
            return $this->dir_handler();
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
        echo view::load('files/password')->with('navs', $navs);
        exit();
    }

    // 文件处理
    function file_handler()
    {
        $item = $this->items[$this->name];
        if ($item['folder']) {
            // 是文件夹
            $url = $_SERVER['REQUEST_URI'] . '/';
        } elseif (!is_null($_GET['t'])) {
            // 缩略图
            $url = $this->thumbnail($item);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' || !is_null($_GET['s'])) {
            return $this->show($item);
        } else {
            // 返回下载链接
            $url = $item['downloadUrl'];
        }

        header('Location: ' . $url);
    }

    // 文件夹处理
    function dir_handler()
    {
        $navs = $this->navs();
        // 以'/'拆分路径，并重新连接
        $except_paths_buffer = explode('/', config('except_path'));
        $except_path_buffer = get_absolute_path(join('/', $except_paths_buffer));
        $upload_paths_buffer = explode('/', config('offline')['upload_path']);
        $upload_path_buffer = get_absolute_path(join('/', $upload_paths_buffer));
        $online = config('offline')['online'];
        //定义变脸，表示是否渲染此目录下的文件
        $iscolorbar = true;
        //不渲染设置为all，或者当前路径与指定不渲染路径相同，则不渲染。如果设置为空，则渲染
        if (strcmp(config('except_path'), 'all') == 0 || strcmp(get_absolute_path($this->path), get_absolute_path(config('onedrive_root') . $except_path_buffer)) == 0) {
            $iscolorbar = false;
        } else if (empty(config('except_path'))) {
            $iscolorbar = true;
        }
        //指定的游客在线上传路径是否和当前路径一致，相同则不渲染。
        if (strcmp(get_absolute_path($this->path), get_absolute_path(config('onedrive_root') . $upload_path_buffer)) == 0) {
            $iscolorbar = false;
        }

        if ($iscolorbar) {
            if ($this->items['index.html']) {
                $this->items['index.html']['path'] = get_absolute_path($this->path) . 'index.html';
                $index = $this->get_content($this->items['index.html']);
                header('Content-type: text/html');
                echo $index;
                exit();
            }

            if ($this->items['README.md']) {
                $this->items['README.md']['path'] = get_absolute_path($this->path) . 'README.md';
                $readme = $this->get_content($this->items['README.md']);
                $Parsedown = new Parsedown();
                $readme = $Parsedown->text($readme);
                //不在列表中展示
                unset($this->items['README.md']);
            }

            if ($this->items['HEAD.md']) {
                $this->items['HEAD.md']['path'] = get_absolute_path($this->path) . 'HEAD.md';
                $head = $this->get_content($this->items['HEAD.md']);
                $Parsedown = new Parsedown();
                $head = $Parsedown->text($head);
                //不在列表中展示
                unset($this->items['HEAD.md']);
            }
        }

        //在线上传条件，后台开启或者登陆为管理员
        if (config('offline')['online'] || is_login()) {
            $manager['online'] = true;
        } else {
            $manager['online'] = false;
        }

        if (config('offline')['offline'] || is_login()) {
            $manager['offline'] = true;
        } else {
            $manager['offline'] = false;
        }

        if (is_login()) {
            $manager['create_folder'] = true;
        } else {
            $manager['create_folder'] = false;
        }
        return view::load('files/index')->with('title', empty(str_replace("/", "", urldecode($this->url_path))) ? "根目录" : str_replace("/", "", urldecode($this->url_path)))
            ->with('navs', $navs)
            ->with('path', join("/", array_map("rawurlencode", explode("/", $this->url_path))))
            ->with('root', ROOT_URL . 'files/')
            ->with('download', ROOT_URL . 'download/')
            ->with('items', $this->items)
            ->with('head', $head)
            ->with('readme', $readme)
            ->with('manager', $manager);
    }

    function show($item)
    {
        $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
        $data['title'] = $item['name'];
        $data['navs'] = $this->navs();
        $data['item'] = $item;
        $data['ext'] = $ext;
        $data['item']['path'] = get_absolute_path($this->path) . $this->name;
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $uri = onedrive::urlencode(get_absolute_path($this->url_path . '/' . $this->name));
        $data['url'] = $http_type . $_SERVER['HTTP_HOST'] . ROOT_URL . 'download/' . $uri;

        $show = config('show');
        foreach ($show as $n => $exts) {
            if (in_array($ext, $exts)) {
                return view::load('files/show/' . $n)->with($data);
            }
        }

        header('Location: ' . $item['downloadUrl']);
    }

    // 缩略图
    function thumbnail($item)
    {
        if (!empty($_GET['t'])) {
            list($width, $height) = explode('|', $_GET['t']);
        } else {
            //800 176 96
            $width = $height = 800;
        }
        $item['thumb'] = onedrive::thumbnail($this->path . $this->name);
        list($item['thumb'], $tmp) = explode('&width=', $item['thumb']);
        $item['thumb'] .= strpos($item['thumb'], '?') ? '&' : '?';
        return $item['thumb'] . "width={$width}&height={$height}";
    }

    // 文件下载
    function download()
    {
        // 是否404
        $this->is404();

        $this->is_password();

        header("Expires:-1");
        header("Cache-Control:no_cache");
        header("Pragma:no-cache");

        if (!empty($this->name)) {
            header('Location: ' . $this->items[$this->name]['downloadUrl']);
        } else {
            // 不是文件
            http_response_code(404);
            view::load('files/404')->show();
            die();
        }
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
        view::load('files/404')->show();
        die();
    }

    function __destruct()
    {
        if (!function_exists("fastcgi_finish_request")) {
            return;
        }
    }
}
