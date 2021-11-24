<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\Db;
class Common extends Controller
{
    //检查是否登录
    public function initialize()
    {
        //接口头部传来的Token
        $token = input('server.HTTP_TOKEN');
        if(empty($token)){
            echo json_encode(['code'=>400,'msg'=>'请输入token信息','data'=>'']);
            exit;
        }
        //接受返回的结果
        $checkToken = checkToken($token);
        $data = json_decode($checkToken);
        if($data->code == 103){
            echo json_encode(['code'=>400,'msg'=>'token过期,重新登录','data'=>'']);
            exit;
        }
        elseif($data->code != 200){
            echo json_encode(['code'=>400,'msg'=>'token错误','data'=>'']);
            exit;
        }else{
            //token用户信息
            $this->userInfo= $data->data;
        }

    }

}
?>