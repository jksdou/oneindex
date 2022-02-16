<?php
class IndexController
{
    private $url_path;
    private $name;
    private $path;
    private $items;
    private $time;

    function __construct()
    {
        // 获取路径和文件名
        $paths = explode('/', rawurldecode($_GET['path']));
        if (substr($_SERVER['REQUEST_URI'], -1) != '/') {
            $this->name = array_pop($paths);
        }
    }


    function index()
    {
        // 是否404
        // $this->is404();
        $data['title'] = '首页';
        $data['navs'] = [];
        return view::load('index')->with($data);
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
