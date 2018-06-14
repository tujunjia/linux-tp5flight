<?php
namespace app\common\validate;
use think\Validate;
class User extends Validate{
    protected $rule = [
        'username' => ['require','length'=>'2,18'],
        'mobile' => ['require' , 'number' , 'unique'=>'user', 'length'=>11,],
        'id_card' => ['require' , 'number' , 'unique'=>'user', 'length'=>18],
        'password'=>['require' , 'confirm' ,'regex'=>'/^[A-Za-z0-9\_]{6,18}$/'],
    ];

    protected $message = [

        'username.require' => '用户名不能为空',
        'username.length' => '用户名长度在5到18位之间你这是假名字',
        'mobile.unique'=>'此手机号已经被注册，请更换手机号',
        'mobile.require'=>'手机号不能为空',
        'mobile.length' => '手机号要11位',
        'id_card.unique'=>'此身份证已经被注册，请更换手机号',
        'id_card.require'=>'身份证号不能为空',
        'id_card.length' => '身份证号要18位',
        'password.regex'=>'密码必须为6到18位的英文数字大小写和_符号',
        'password.require'=>'密码不能为空',
        'password.confirm'=>'两次密码不一致',

    ];
}