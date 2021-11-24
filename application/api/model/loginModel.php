<?php
namespace app\api\model;
use think\Model;

class loginModel extends Model {
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';
    protected $pk = 'user_id';
    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }
    public function __construct($name='', $tablePrefix='', $connection=''){
        parent::__construct($name, $tablePrefix, $connection);
    }
    public function login($param){
        $id = $param['user_id'];
        $data = loginModel::where('user_id','>',10)->select();
        halt($data);
    }
}
?>