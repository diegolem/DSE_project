<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }
    public function users()
    {
        return view('admin.home');
    }
}
