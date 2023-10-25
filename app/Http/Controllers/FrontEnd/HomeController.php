<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.about');
    }
    public function features()
    {
        return view('pages.features');
    }
    public function privacy()
    {
        return view('pages.privacy');
    }
    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
    public function termsService()
    {
        return view('pages.terms-of-service');
    }
    public function dataPrivacy()
    {
        return view('pages.data-privacy-notice');
    }

}