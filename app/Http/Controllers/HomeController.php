<?php

namespace App\Http\Controllers;
use App\Models\Prop\HomeType;
use App\Models\Prop\Property;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contact()
    {
        // access data from pages folder's contact blade php
        return view('pages.contact');
    }

    public function about()
    {
        // access data from pages folder's contact blade php
        return view('pages.about');
    }

    // dynamic selection
    public function showHomeType()
    {
        $homeTypes = HomeType::table('hometypes')->get(); 
        return view('home', compact('homeTypes')); 
    }

}
