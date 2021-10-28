<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class NotifyController extends Controller
{
    public  function notify(){

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
