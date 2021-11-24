<?php
namespace app\api\controller;
use think\Request;
use app\api\model\indexModel;
class Index extends Common
{
    /**
     * @var \think\Request Request实例
     */
    protected $request;

    public function index(indexModel $indexModel)
    {
        if($this->request->isPost()){
            $userInfo = $this->userInfo->data;
            $param = $this->request->param();
            $indexModel->classType($param,$userInfo);
        }else{
            echo '非法请求！';exit;
        }
    }

}