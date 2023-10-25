<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
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
        return view('pages.frontend.about');
    }
    public function features()
    {
        return view('pages.frontend.features');
    }
    public function privacy()
    {
        return view('pages.frontend.privacy');
    }
    public function disclaimer()
    {
        return view('pages.frontend.disclaimer');
    }
    public function termsService()
    {
        return view('pages.frontend.terms-of-service');
    }
    public function dataPrivacy()
    {
        return view('pages.frontend.data-privacy-notice');
    }

}