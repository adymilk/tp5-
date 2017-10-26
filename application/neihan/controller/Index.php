<?php
namespace app\neiHan\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $url = "http://lf.snssdk.com/neihan/service/tabs/";
        $result = file_get_contents($url);
        $result = json_decode($result);
        $data = $result->data;
        $this->assign("data",$data);

        $videoUrl = "http://iu.snssdk.com/neihan/stream/mix/v1/?mpic=1&webp=1&essence=1&content_type=-104&message_cursor=-1&am_longitude=110&am_latitude=120&am_city=%E5%8C%97%E4%BA%AC%E5%B8%82&am_loc_time=1463225362314&count=6&min_time=1465232121&screen_width=1450&do00le_col_mode=0&iid=3216590132&device_id=32613520945&ac=wifi&channel=360&aid=7&app_name=joke_essay&version_code=612&version_name=6.1.2&device_platform=android&ssmix=a&device_type=sansung&device_brand=xiaomi&os_api=28&os_version=6.10.1&uuid=326135942187625&openudid=3dg6s95rhg2a3dg5&manifest_version_code=612&resolution=1450*2800&dpi=620&update_version_code=6120";
        $result = file_get_contents($videoUrl);
        $result = json_decode($result);
        $videoData = $result->data->data;

//        dump($videoData);
        $this->assign("video",$videoData);
        return $this->fetch();
    }
}
