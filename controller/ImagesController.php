<?php

class ImagesController
{
    private $images_config;

    function __construct()
    {
        $this->images_config = config('images@base');
    }

    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function index()
    {
        if (is_login() || $this->images_config['public']) {
            if ($this->image_check($_FILES["file"])) {
                $filename = $_FILES["file"]['name'];
                $content = file_get_contents($_FILES["file"]['tmp_name']);
                $remotepath =  'images/' . date('Y/m/d/') . $this->generateRandomString(10) . '/';
                $remotefile = $remotepath . $filename;
                $result = onedrive::upload(config('onedrive_root') . $remotefile, $content);

                if ($result) {
                    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                    $url = $_SERVER['HTTP_HOST'] . ROOT_URL . 'files/' . $remotepath . rawurldecode($filename) . ((config('root_path') == '?') ? '&s' : '?s');
                    $url = $http_type . str_replace('//', '/', $url);
                    view::direct($url);
                }
            }
            return view::load('images/index')->with('title', '图床上传');
        }
        return view::load('images/closed')->with('title', '图床未开放');
    }

    function image_check($file)
    {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $this->images_config['exts'])) {
            return false;
        }
        if ($file['size'] > 10485760 || $file['size'] == 0) {
            return false;
        }

        return true;
    }

    function upload()
    {
        header('Content-Type:application/json; charset=utf-8');
        if (empty($this->images_config['auth'])) {
            exit("接口已关闭");
        }
        if (empty($_SERVER['HTTP_APIAUTH'])) {
            exit("缺少授权码");
        }
        if ($this->image_check($_FILES["file"])) {
            if ($_SERVER['HTTP_APIAUTH'] != $this->images_config['auth']) {
                exit("授权码校验失败！");
            }
            //$filename = $_FILES["file"]['name'];
            $filename = $this->generateRandomString(10) . '.' . substr(strrchr($_FILES["file"]['name'], '.'), 1);
            $content = file_get_contents($_FILES["file"]['tmp_name']);
            $images_path = 'images/';
            $remotepath =  $images_path . date('Y/m/d/');
            $remotefile = $remotepath . $filename;
            $result = onedrive::upload(config('onedrive_root') . $remotefile, $content);
            cache::clear();
            if ($result) {
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $url = $_SERVER['HTTP_HOST'] . ROOT_URL . 'files/' . $remotepath . rawurldecode($filename);
                $url = $http_type . str_replace('//', '/', $url);
                // exit(json_encode($url));
                exit($url);
            }
            exit("文件上传失败！");
        }
        exit("该文件类型不允许上传！");
    }
}
