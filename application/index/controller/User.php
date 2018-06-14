<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User as UserModel;

class User extends Base
{
    /**
     * @return array|\think\response\View
     * 渲染index视图的方法
     */
    public function index()
    {
        $this->checkUserLoged();
        return view();
    }

    /**
     * @return array|\think\response\View
     * 渲染注册视图
     */
    public function reg(){
        return view();
    }

    /**
     * @return array|\think\response\View
     * 用户登录界面
     */
    public function login(){
        $this->checkLoginStatus();
        return view();
    }

    /**
     * @return array
     *           添加用户的方法
     */
    public function add(){
        if(request()->isAjax()){
            $user = new UserModel();
            if($user->allowField(true)->validate(true)->save(input('post.'))){
                return ['status' => 1 , 'msg'=>'新用户注册成功！'];
            }else{
                return ['status' => 0 , 'msg'=>$user->getError()];
            }
        }
        return ['status' => 0 , 'msg'=>'未知错误'];
    }

    /**
     * @return array
     * 用户登录操作界面
     */
    public function doLogin()
    {

        if(request()->isAjax())
        {
            $user = new UserModel();
            return $user->checkUserLogin(input('param.'));
        }
        return ['status' => 0];
    }

    /**
     * 用户退出登陆操作
     */
    public function logout()
    {
        // 清空session值
        session('user_id' , null);
        session('user_info' , null);
        $this->success('退出登录成功!',url('index/user/login'));
    }
}
