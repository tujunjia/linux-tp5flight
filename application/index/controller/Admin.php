<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User as UserModel;
use app\common\model\Flight as FlightModel;

class Admin extends Base
{
    /**
     * @return array|\think\response\View
     * 渲染管理员界面
     */
    public function index(){
        $this->checkAdminLoged();
        return view();
    }

    /**
     * @return array|\think\response\View
     * 渲染管理员登录界面
     */
    public function login(){
        $this->checkAdminLoginStatus();
        return view();
    }

    /**
     * @return array
     * 管理员登录的方法
     */
    public function doLogin()
    {
        if(request()->isAjax())
        {
            $user = new UserModel();
            return $user->checkAdminLogin(input('param.'));
        }
        return ['status' => 0];
    }


    /**
     * @return array
     * 航班添加的de方法
     */
    public function addFlight(){

        if(request()->isAjax()){
            $flight = new FlightModel();
            if($flight->validate(true)->save(input('post.'))){
                return ['status' => 1 , 'msg'=>'航班创建成功！'];
            }else{
                return ['status' => 0 , 'msg'=>$flight->getError()];
            }
        }
        return ['status' => 0 , 'msg'=>'未知错误'];
    }
}
