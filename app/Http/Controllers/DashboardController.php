<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return view('dashboard.index');
    }
    
    public function showAllPosts() {
        return view('dashboard.allPosts');
    }
    public function showAllTags() {
        return view('dashboard.allTags');
    }
    public function showAllImages() {
        return view('dashboard.allImages');
    }
}
