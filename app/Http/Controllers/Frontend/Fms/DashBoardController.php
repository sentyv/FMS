<?php

namespace App\Http\Controllers\Frontend\Fms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index(){

        return view('frontend.fms.dashboard');
    }
}
