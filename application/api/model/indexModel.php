<?php
/*
 * @Author: your name
 * @Date: 2021-11-24 11:30:37
 * @LastEditTime: 2021-11-26 16:52:58
 * @LastEditors: Please set LastEditors
 * @Description: 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 * @FilePath: \xcx_jizhang\test\application\api\model\indexModel.php
 */
namespace app\api\model;
use think\Model;
use think\Db;
use think\cache\driver\Redis;

class indexModel extends Model {
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';
    protected $pk = 'user_id';
    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }
//    public function __construct($name='', $tablePrefix='', $connection=''){
//        parent::__construct($name, $tablePrefix, $connection);
//    }

    /**
     * 获取标签
     * @param $userInfo object() 用户信息
     * @author 韩天松
     * @date 2021-11-22 16:26
     */
    public function getLabelList($userInfo){
        $data = indexModel::where('user_id','eq',$userInfo->id)->value('is_lable');
        $redis = new Redis();
        if($data == 0){
            //公共支出标签
            if($redis->llen('labelListOutPub')==0){
                //没有自定义 查询公共标签
                $labelListOut = Db::table('label')
                ->field('label_id,title,zt')
                ->where('zt',1)
                ->where('is_delete',1)
                ->order('sort')
                ->select();
                $redis->lpush('labelListOutPub',json_encode($labelListOut));
            }else{
                $labelListOut = json_decode($redis->lrange('labelListOutPub',0,-1)[0],true);
            }
            //公共收入标签
            if($redis->llen('labelListInPub')==0){
                $labelListIn = Db::table('label')
                ->field('label_id,title,zt')
                ->where('zt',2)
                ->where('is_delete',1)
                ->order('sort')
                ->select();
                $redis->lpush('labelListInPub',json_encode($labelListIn));
            }else{
                $labelListIn = json_decode($redis->lrange('labelListInPub',0,-1)[0],true);
            }
        }else{
            //用户自定义了标签 查询自定义标签
            if($redis->llen('labelListOutPri'.$userInfo->id)==0){
                $labelListOut = Db::table('user_label')
                ->field('label_id,title,zt')
                ->where('zt',1)
                ->where('user_id',$userInfo->id)
                ->where('is_delete',1)
                ->order('sort')
                ->select();
                $redis->lpush('labelListOutPri'.$userInfo->id,json_encode($labelListOut));
            }else{
                $labelListOut = json_decode($redis->lrange('labelListOutPri'.$userInfo->id,0,-1)[0],true);
            }
            if($redis->llen('labelListInPri'.$userInfo->id)==0){
                $labelListIn = Db::table('user_label')
                ->field('label_id,title,zt')
                ->where('zt',2)
                ->where('user_id',$userInfo->id)
                ->where('is_delete',1)
                ->order('sort')
                ->select();
                $redis->lpush('labelListInPri'.$userInfo->id,json_encode($labelListIn));
            }else{
                $labelListIn = json_decode($redis->lrange('labelListInPri'.$userInfo->id,0,-1)[0],true);
            }
        }
        $labelList['out'] = $labelListOut;
        $labelList['in'] = $labelListIn;
        return $labelList;
    }
    /**
     * 计算某月总收支
     * @param $userInfo object() 用户信息
     * @date 2021-11-26 11:14
     */
    public function getThisMonthMoney($userInfo,$year='',$month='',$label=''){
        //当前年月日
        if($year == ''){
            $year = date("Y");
        }
        if($month == ''){
            $month = date("m");
        }
        $where = [];
        if($label){
            $where['label_id'] = $label;
        }
        $redis = new Redis();
        //计算某月支出总额
        if($redis->exists('outMoney')){
            $thisMonthOutMoney = $redis->get('thisMonthOutMoney'.$userInfo->id);
        }else{
            $thisMonthOutMoney = Db::table('bill')
                ->where('user_id',$userInfo->id)
                ->where('is_delete',1)
                ->where('type',1)
                ->where('year',$year)
                ->where('month',$month)
                ->where($where)
                ->value('sum(outprice) as outMoney');
            if(empty($thisMonthOutMoney)){
                $thisMonthOutMoney = 0;
            }
            $redis->set('thisMonthOutMoney'.$userInfo->id,$thisMonthOutMoney);
            $redis->expire('thisMonthOutMoney'.$userInfo->id,3600*24);
        }
        //计算某月收入总额
        if($redis->exists('inMoney')){
            $thisMonthInMoney = $redis->get('thisMonthInMoney'.$userInfo->id);
        }else{
            $thisMonthInMoney = Db::table('bill')
                ->where('user_id',$userInfo->id)
                ->where('is_delete',1)
                ->where('type',2)
                ->where('year',$year)
                ->where('month',$month)
                ->where($where)
                ->value('sum(inprice) as inMoney');
            if(empty($thisMonthInMoney)){
                $thisMonthInMoney = 0;
            }
            $redis->set('thisMonthInMoney'.$userInfo->id,$thisMonthInMoney);
            $redis->expire('thisMonthInMoney'.$userInfo->id,3600*24);
        }
        $thisMonthMoney['out'] = $thisMonthOutMoney;
        $thisMonthMoney['in'] = $thisMonthInMoney;
        return $thisMonthMoney;
    }
    /**
     * 收支列表
     * @param $userInfo object() 用户信息
     * @date 2021-11-26 16:06
     */
    public function getBillList($param,$userInfo,$year='',$month='',$label=''){
        $page = empty($param['page'])?1:$param['page'];
        $limit = empty($param['limit'])?10:$param['limit'];
        $current = ($page-1)*$limit;
         //当前年月日
         if($year == ''){
            $year = date("Y");
        }
        if($month == ''){
            $month = date("m");
        }
        $where = [];
        if($label){
            $where['label_id'] = $label;
        }
        $list = Db::table('bill')
            ->field('bill_id,month,day,type,sum(inprice) as allinmoney,sum(outprice) as alloutmoney')
            ->where('user_id',$userInfo->id)
            ->where('is_delete',1)
            ->where('year',$year)
            ->where('month',$month)
            ->order('day','desc')
            ->group('day')
            ->limit($current,$limit)
            ->select();
        foreach($list as $key=>$value){
            $list[$key]['childList'] = Db::table('bill')
                ->field('title,outprice as outmoney,inprice as inMoney')
                ->where('user_id',$userInfo->id)
                ->where('is_delete',1)
                ->where('year',$year)
                ->where('month',$month)
                ->where('day',$value['day'])
                ->order('type','desc')
                ->order('create_time','asc')
                ->select();
        }
        return $list;
    }
}
?>