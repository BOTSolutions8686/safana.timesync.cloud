<?php

namespace App\Http\Controllers\Frontend\Auth;

use Config;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function adminLogin()
    {
        $users=[];
        try {
            if (Auth::check()) {
                return redirect('dashboard');
            }

            $branch=Config::get('app.APP_BRANCH');
            $APP_STYLE=Config::get('app.APP_STYLE');
            if($branch=='nonsaas' && env('APP_SYNC') == 'true'){
                $users= User::with('role')->whereIn('id', [3,4])->select('id','name', 'email','role_id')->get();
            }elseif( $branch=='saas' && $APP_STYLE=='demo' && env('APP_SYNC') == 'true'){
                $users= User::with('role')->whereIn('id', [2,3,4])->select('id','name', 'email','role_id')->get();
            }else{
                $users=[];
            }
            return view('backend.auth.admin_login', compact('users'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong'), 'Error');
            return redirect('/');
        }
    }

    public function LoginForm()
    {
        return view('backend.auth.admin_login');
    }
}