<?php
namespace app\common\model;
use think\Model;
class Flight extends Model{

    //数据库表的确定
    protected $name='flight';


    protected $auto = ['fly_time',];
    //修改器，更改fly_time
    public function setFly_timeAttr($value,$data){
        if($data['fly_time']){
            return md5($data['fly_time']);
        }
        return '';
    }
}