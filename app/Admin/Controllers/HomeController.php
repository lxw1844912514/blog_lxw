<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //首页
    public function index()
    {
        $user = Auth::user();
        $users=DB::table('admin_users')->count();
        $posts=DB::table('posts')->count();
        $comments=DB::table('comments')->count();
        return view('admin/home/index', compact('user','users','posts','comments'));
    }
}


