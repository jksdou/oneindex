<?php
// 小于 10M 的文件使用 Office 组件在线预览
if ($item["size"] < 10485760) {
    $url = 'https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($item['downloadUrl']);
    view::direct($url);
} else {
    view::direct($item['downloadUrl']);
}
exit();
