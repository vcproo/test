<?php
namespace app\index\controller;
use Firebase\JWT\JWT;
use think\Request;
class Index
{
    public function index()
    {
        $arr = ['id'=>1,'name'=>"张三",'headimg'=>'1.jpg'];
        $data = createToken($arr);
//       $data = $this->createToken();
       halt($data);
    }
    public function getToken(){
        //接口头部传来的Token
        $token = input('server.HTTP_TOKEN');
        //接受返回的结果
        $checkToken = checkToken($token);
        halt($checkToken);

    }

}
