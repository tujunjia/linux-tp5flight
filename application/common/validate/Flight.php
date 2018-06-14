<?php
namespace app\common\validate;
use think\Validate;
class Flight extends Validate{
    protected $rule = [
        'flight_name'=>['require'],
        'departurePlace' => ['require'],
        'destination' => ['require'],
        'fly_time' => ['require'],
        'price'=>['require' ,'number'],
    ];

    protected $message = [
        'flight_name.require' => '航班名称不能为空',
        'departurePlace.require' => '起飞地不能为空',
        'destination.require'=>'目的地不能为空',
        'fly_time.require'=>'起飞时间不能为空',
//        'fly_time.time'=>'起飞时间必须为时间格式',
        'price.require'=>'价格不能为空',
        'price.number'=>'价格必须为数字型',

    ];
}