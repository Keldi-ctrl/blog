<?php

namespace App\Http\Controllers;

use App\Models\SiteText;
use Illuminate\Http\Request;

class MainController extends Controller
{

  public function index()
  {
    $path = storage_path() . "/json/texts.json";
    $decodeJson = json_decode(file_get_contents($path), true);
    $texts = SiteText::Where('section', "slider")->get();
    return view('pages/index', [
      'texts' => $texts,
      'decodeJson' => $decodeJson
    ]);
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
