<?php
/*
 * @Author: your name
 * @Date: 2021-11-24 11:30:37
 * @LastEditTime: 2021-11-26 16:43:16
 * @LastEditors: Please set LastEditors
 * @Description: 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 * @FilePath: \xcx_jizhang\test\application\api\controller\Index.php
 */
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
            //获取标签
            $labelList = $indexModel->getLabelList($userInfo);
            //计算某月收支金额
            $thisMonthMoney = $indexModel->getThisMonthMoney($userInfo);
            //获取收支列表
            $billList = $indexModel->getBillList($param,$userInfo);
        }else{
            echo '非法请求！';exit;
        }
    }

}