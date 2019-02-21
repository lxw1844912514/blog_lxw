<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
//        $notices=Notice::paginate(10);
        //获取当前用户
        $user=\Auth::user();
        $notices=$user->notices;
        return view('notice/index',compact('notices'));
    }
}
