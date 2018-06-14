<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    //表名的声明
    protected $name = 'user';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    // 自动完成 新增和更新都执行
    protected $auto = ['password',];
    // 只是新增的时候
    protected $insert = ['status' => 1,];
    // 只是更新的时候
    protected $update = ['update_time',];

    // 密码md5序列化
    public function setPasswordAttr($value , $data){
        if($data['password']){
            return md5($data['password']);
        }
        return '';
    }

    /**
     *     * 检测用管理员密码是否正确
     * @param $data
     * @return array
     */
    public function checkAdminLogin($data){
        // 构建查询的条件
        $map = [
            'mobile' => $data['mobile'],
            'password' => md5($data['password']),
            'status' => 1,
            'is_admin'=>1,
        ];
        // 用户条件查询
        $userinfo = self::get($map);
        // 结果匹配与提示
        if($userinfo === null){
            return ['status' => 0 , 'msg'=> '手机号或者密码或者用户类型错误！'];
        }
        // 记录用户的状态
        session('user_id' , $userinfo->data['id']);
        session('user_info' , $userinfo->data);
        return ['status' => 1 , 'msg'=>'用户登录成功！正在跳转...'];
    }

    /**
     * @param $data
     * @return array
     * 检测用户名密码是否正确
     */
    public function checkUserLogin($data){
        // 构建查询的条件
        $map = [
            'mobile' => $data['mobile'],
            'password' => md5(md5($data['password'])),
            'status' => 1,
            'is_admin'=>0,
        ];
        // 用户条件查询
        $userinfo = self::get($map);
        // 结果匹配与提示
        if($userinfo === null){
            return ['status' => 0 , 'msg'=> '手机号或者密码或者用户类型错误'];
        }
        // 记录用户的状态
        session('user_id' , $userinfo->data['id']);
        session('user_info' , $userinfo->data);
        return ['status' => 1 , 'msg'=>'用户登录成功！正在跳转...'];
    }
}
