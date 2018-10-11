<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 登录页面
     */
    public function index()
    {

        //User::create(['email'=>'admin@test.com','password'=>bcrypt('admin')]);
        return view('login/index');
    }

    /**
     * 登录逻辑
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:4|max:30',
        ]);

        $user = request(['email','password']);
        if(true == \Auth::attempt($user,intval(request('remember_token')))){
            return redirect(route('admin.index'));
        }

        return redirect()->back()->withErrors('账号或密码错误!');
    }

    /**
     * 注销
     */
    public function loginOut()
    {
        \Auth::logout();
        return redirect()->route('login');
    }
}
