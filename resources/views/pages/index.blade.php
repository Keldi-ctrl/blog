@extends('layout.layout')
@section('title') {{ $decodeJson['index_page_title'] }} @endsection
@section('content')
  <!-- Responsive slider - START -->
<div class="slider">
  <div class="container">
    <div class="row">
      <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
        <div class="slides" data-group="slides">
          <ul>
            @foreach ($texts as $text)
              <li>
                <div class="slide-body" data-group="slide">
                  <img src="{{ asset($text['img_url']) }}" alt="">
                  <div class="caption header" data-animate="slideAppearUpToDown" data-delay="500" data-length="300">
                    <button class="btn btn-primary"><h2> {{ $text['title'] }}</h2></button>
                    <div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200" data-length="300">
                      <button class="btn btn-primary"><h4><span>{{ $text['title'] }}</span>
                        </h4></button>
                    </div>
                    <div class="caption-sub" data-animate="slideAppearLeftToRight" data-delay="900" data-length="300">
                      <button class="btn btn-primary"><h3>{{ $text['created_at'] }}</h3></button>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        <a class="slider-control left" href="#" data-jump="prev"><i class="fa fa-angle-left fa-2x"></i></a>
        <a class="slider-control right" href="#" data-jump="next"><i class="fa fa-angle-right fa-2x"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- Responsive slider - END -->

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="contents">
        <h2>{{ $decodeJson['create_your_outstanding'] }}</h2>
        <p>{{ $decodeJson['create_your_outstanding_sub'] }}</p>
      </div>
    </div>
  </div>
</div>

@include('includes.recent_works')

<div class="container">
  <div class="row">
    <div class="box">

      <div class="col-md-6">
        <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="0.8s">
          <div class="align-center">
            <h4>Quick Support</h4>
            <div class="icon">
              <i class="fa fa-heart-o fa-3x"></i>

            </div>
            <p>
              Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.
            </p>
            <div class="ficon">
              <a href="" alt="">Learn more</a> <i class="fa fa-long-arrow-right"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="1.3s">
          <div class="align-center">
            <h4>Easy Customize</h4>
            <div class="icon">
              <i class="fa fa-laptop fa-3x"></i>

            </div>
            <p>
              Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.
            </p>
            <div class="ficon">
              <a href="" alt="">Learn more</a> <i class="fa fa-long-arrow-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--about-->
@include('includes.about')
<!--/about-->

<!--Отзывы-->
@include('includes.reviews', ['reviewFromCustomer' => $decodeJson['review_from_customer'] ] )
<!--/about-->

<div class="container">
  <div class="row">
    <hr>
  </div>
</div>
@endsection