<?php

namespace App\Http\Controllers;

use App\Models\SiteText;
use Illuminate\Http\Request;

class MainController extends Controller
{

  public function index()
  {
    $text = SiteText::Where('section', "slider")->get();
    return view('pages/index', ['texts' => $text]);
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
