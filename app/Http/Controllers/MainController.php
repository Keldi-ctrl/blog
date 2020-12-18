<?php

namespace App\Http\Controllers;

use App\Models\SiteText;
use Illuminate\Http\Request;

class MainController extends Controller
{
  /**
   * @var
   */
  public $decodedJson;

  public function __construct()
  {
    $path = storage_path() . "/json/texts.json";
    $this->decodedJson = json_decode(file_get_contents($path), true);
  }

  public function index()
  {
    $texts = SiteText::Where('section', "slider")->get();
    return view('pages/index', [
      'texts' => $texts,
      'decodedJson' => $this->decodedJson
    ]);
  }

  public function blog()
  {
    return view('pages/blog', [
      'decodedJson' => $this->decodedJson
    ]);
  }

  public function portfolio()
  {
    return view('pages/portfolio', [
      'decodedJson' => $this->decodedJson
    ]);
  }

  public function contact()
  {
    return view('pages/contact', [
      'decodedJson' => $this->decodedJson
    ]);
  }
}
