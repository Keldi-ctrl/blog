<!DOCTYPE html>
<html lang="ru">
<head>
  @include('includes.head')
</head>
<body>
<header>
  @include('includes.header')
</header>

<!-- Responsive slider - START -->
<div class="slider">
  <div class="container">
    <div class="row">
      <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
        <div class="slides" data-group="slides">
          <ul>
            <li>
              <div class="slide-body" data-group="slide">
                <img src="{{ asset('img/2a.jpg') }}" alt="">
                <div class="caption header" data-animate="slideAppearUpToDown" data-delay="500" data-length="300">
                  <button class="btn btn-primary"><h2> we are creative design</h2></button>
                  <div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200" data-length="300">
                    <button class="btn btn-primary"><h4><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet.</span>
                      </h4></button>
                  </div>
                  <div class="caption-sub" data-animate="slideAppearLeftToRight" data-delay="900" data-length="300">
                    <button class="btn btn-primary"><h3>With one to one swipe movement!</h3></button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="slide-body" data-group="slide">
                <img src="{{ asset('img/1.jpg') }}" alt="">
                <div class="caption header" data-animate="slideAppearDownToUp" data-delay="500" data-length="300">
                  <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                          autocomplete="off"><h2>creative design Responsive slider</h2></button>
                  <div class="caption-sub" data-animate="slideAppearUpToDown" data-delay="800" data-length="300">
                    <button class="btn btn-primary"><h4><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet. </span>
                      </h4></button>
                  </div>
                  <div class="caption-sub" data-animate="slideAppearRightToLeft" data-delay="1200" data-length="300">
                    <button class="btn btn-primary"><h3>Clean and Flat</h3></button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="slide-body" data-group="slide">
                <img src="{{ asset('img/10.jpg') }}" alt="">
                <div class="caption header" data-animate="slideAppearUpToDown" data-delay="500" data-length="300">
                  <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                          autocomplete="off"><h2>creative design Custom animations</h2></button>
                  <div class="caption-sub" data-animate="slideAppearLeftToRight" data-delay="800" data-length="300">
                    <button class="btn btn-primary"><h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit
                        amet.</h4></button>
                  </div>
                  <div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200" data-length="300">
                    <button class="btn btn-primary"><h3><span>New style Slides!</span></h3></button>
                  </div>

                </div>
              </div>
            </li>

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
        <h2>Create your outstanding <span>clean</span> and <span>hight quality</span> website</h2>
        <p>Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.</p>
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

@include('includes.our_team')

<div class="container">
  <div class="row">
    <hr>
  </div>
</div>

<!--start footer-->
<footer>
  @include('includes.footer')
</footer>
<!--end footer-->
 @include('includes.scripts')
</body>
</html>