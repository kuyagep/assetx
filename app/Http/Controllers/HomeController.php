<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }
    public function about()
    {
        return view('about');
    }
    public function features()
    {
        return view('features');
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function terms_condition()
    {
        return view('terms-condition');
    }

}