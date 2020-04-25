<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class NotLoginController extends Controller
{
    //topページを表示
    public function top() {
        return view('top');
    }
}
