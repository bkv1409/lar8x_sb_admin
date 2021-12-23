<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SBAdminController extends Controller
{
    public function index()
    {
        return view('sb-admin-tmp.index');
    }

    public function layoutStatic()
    {
        return view('sb-admin-tmp.layout-static');
    }

    public function layoutSidenavLight()
    {
        return view('sb-admin-tmp.layout-sidenav-light');
    }

    public function charts()
    {
        return view('sb-admin-tmp.charts');
    }

    public function tables()
    {
        return view('sb-admin-tmp.tables');
    }

    public function login()
    {
        return view('sb-admin-tmp.login');
    }

    public function register()
    {
        return view('sb-admin-tmp.register');
    }


    public function password()
    {
        return view('sb-admin-tmp.password');
    }

    public function error401()
    {
        return view('sb-admin-tmp.401');
    }

    public function error404()
    {
        return view('sb-admin-tmp.404');
    }

    public function error500()
    {
        return view('sb-admin-tmp.500');
    }
}
