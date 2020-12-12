<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

  public function index()
  {
    return view('pages/index');
  }

  public function blog()
  {
    return view('pages/blog');
  }

  public function portfolio()
  {
    return view('pages/portfolio');
  }

  public function contact()
  {
    return view('pages/contact');
  }
}
