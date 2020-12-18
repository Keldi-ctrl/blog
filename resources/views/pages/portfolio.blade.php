@extends('layout.layout')
@section('title') {{ $decodedJson['portfolio_page_title'] }} @endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="recent">
      <button class="btn-primarys"><h3>Portfolio</h3></button>
      <hr>
    </div>
  </div>
</div>

<section class="portfolio">
  <div class="container">
    <div class="row">
      <div class="popup-gallery">
        <div class="col-md-3">
          <a href="img/portfolio/1.jpg" title="The Cleaner"><img src="img/portfolio/1.jpg" class="img-responsive"alt="" /></a>
        </div>
        <div class="col-md-3">
          <a href="img/portfolio/2.jpg" title="The Cleaner"><img src="img/portfolio/2.jpg" class="img-responsive"alt="" /></a>
        </div>
        <div class="col-md-3">
          <a href="img/portfolio/3.jpg" title="The Cleaner"><img src="img/portfolio/3.jpg" class="img-responsive"alt="" /></a>
        </div>
        <div class="col-md-3">
          <a href="img/portfolio/4.jpg" title="The Cleaner"><img src="img/portfolio/4.jpg" class="img-responsive"alt="" /></a>
        </div>
      </div>
    </div>
  </div>


  <div class="box2">
    <div class="container">
      <div class="row">
        <div class="popup-gallery">
          <div class="col-md-3">
            <a href="img/portfolio/5.jpg" title="The Cleaner"><img src="img/portfolio/5.jpg" class="img-responsive"alt="" /></a>
          </div>
          <div class="col-md-3">
            <a href="img/portfolio/6.jpg" title="The Cleaner"><img src="img/portfolio/6.jpg" class="img-responsive"alt="" /></a>
          </div>
          <div class="col-md-3">
            <a href="img/portfolio/7.jpg" title="The Cleaner"><img src="img/portfolio/7.jpg" class="img-responsive"alt="" /></a>
          </div>
          <div class="col-md-3">
            <a href="img/portfolio/8.jpg" title="The Cleaner"><img src="img/portfolio/8.jpg" class="img-responsive"alt="" /></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <div class="row">
    <hr>
  </div>
</div>
@endsection