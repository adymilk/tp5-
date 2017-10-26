<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {


        return $this->fetch();
    }

    public function searchResult(){
        if (isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            date_default_timezone_set("PRC");
            $showapi_appid = '47350';  //替换此值,在官网的"我的应用"中找到相关值
            $showapi_secret = '80c96b01d8d142979a7eef72cefc32c4';  //替换此值,在官网的"我的应用"中找到相关值
            $paramArr = array(
                'showapi_appid'=> $showapi_appid,
                'q'=> $q,
                'page'=> "1"
                //添加其他参数
            );

            //创建参数(包括签名的处理)
            function createParam ($paramArr,$showapi_secret) {
                $paraStr = "";
                $signStr = "";
                ksort($paramArr);
                foreach ($paramArr as $key => $val) {
                    if ($key != '' && $val != '') {
                        $signStr .= $key.$val;
                        $paraStr .= $key.'='.urlencode($val).'&';
                    }
                }
                $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
                $sign = strtolower(md5($signStr));
                $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
                return $paraStr;
            }

            $param = createParam($paramArr,$showapi_secret);
            $url = 'http://route.showapi.com/921-1?'.$param;
            $result = file_get_contents($url);
            $result = json_decode($result);
            $data = $result->showapi_res_body->pagebean->contentlist;
            $this->assign('data',$data);
            return $this->fetch();
        }else{
            $this->error("搜索内容不能为空",'index/index');
//            echo "搜索不能内容为空！";

        }


    }




}