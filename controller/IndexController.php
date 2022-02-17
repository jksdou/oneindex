<?php
class IndexController
{
    private $url_path;

    function __construct()
    {
        // 获取路径和文件名
        $paths = explode('/', rawurldecode($_GET['path']));
        $this->url_path = get_absolute_path(join('/', $paths));
    }

    function index()
    {
        $data['title'] = '首页';
        return view::load('index')->with($data);
    }

    function about()
    {
        $data['title'] = '关于';
        return view::load('about')->with($data);
    }

    function not_found()
    {
        $data['title'] = 'Not Found';
        $data['path'] = $this->url_path;
        header("HTTP/1.1 404 Not Found");
        return view::load('404')->with($data);
        // http_response_code(404);
        // view::load('404')->show();
        // die();
    }

    function __destruct()
    {
        if (!function_exists("fastcgi_finish_request")) {
            return;
        }
    }
}
