<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    public function index(){
        return view('user.user');
    }
    public function logout()  {
        Auth::logout();
        return redirect('/login');
    }
}
