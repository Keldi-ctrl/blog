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
      'decodeJson' => $this->decodedJson
    ]);
  }

  public function blog()
  {
    return view('pages/blog', [
      'decodeJson' => $this->decodedJson
    ]);
  }

  public function portfolio()
  {
    return view('pages/portfolio', [
      'decodeJson' => $this->decodedJson
    ]);
  }

  public function contact()
  {
    return view('pages/contact', [
      'decodeJson' => $this->decodedJson
    ]);
  }
}
