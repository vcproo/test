<?php
namespace app\api\controller;
use think\Request;
use think\Controller;
use think\Model;
use app\api\model\loginModel;
use think\facade\Session;
class Login extends Controller
{
    /**
     * @var \think\Request Request实例
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * 登录
     * @author 韩天松
     * @date 2021-11-17 16:07
     */
    public function login(Request $request,loginModel $loginModel)
    {
        $data = ['id'=>1,'name'=>'user'];
        $token = createToken($data);
        Session::set('token',$token);
        $data=['code'=>200,'msg'=>'success','data'=>$token];
        echo json_encode($data);
        /**if($this->request->isPost()){
            $param = $this->request->param();
            $loginModel ->login($param);
        }else{

        }**/
    }

}