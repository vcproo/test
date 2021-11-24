<?php
namespace app\api\model;
use think\Model;

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
     * 获取分类
     * @param $param
     * @author 韩天松
     * @date 2021-11-22 16:26
     */
    public function classType($param,$userInfo){
        $data = indexModel::where('user_id','eq',$userInfo->id)->value('is_lable');
        if(){

        }
        halt($data);
    }
}
?>