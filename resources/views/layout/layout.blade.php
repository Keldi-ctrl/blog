<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Bootstrap -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive-slider.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<header>
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <div class="navbar-brand">
              <a href="{{ url('/') }}"><h1>Blog</h1></a>
            </div>
          </div>
          <div class="menu">
            <ul class="nav nav-tabs" role="tablist">
              {{--
              {{ Request::path() ==  'portfolio' ? 'active' : ''  }}
              {{ request()->is('portfolio') ? 'active' : '' }}
              --}}
              <li role="presentation" class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>

              <li role="presentation" class="{{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('/blog') }}">blog</a></li>

              <li role="presentation" class="{{ request()->is('portfolio') ? 'active' : '' }}"><a href="{{ url('/portfolio') }}">Portfolio</a></li>

              <li role="presentation" class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>

@yield('content')

<!--start footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">Get in touch with us</h5>
          <address>
            <strong>Arsha company Inc</strong><br>
            Modernbuilding suite V124, AB 01<br>
            Someplace 16425 Earth
          </address>
          <p>
            <i class="icon-phone"></i> (123) 456-7890 - (123) 555-7891 <br>
            <i class="icon-envelope-alt"></i> email@domainname.com
          </p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">Pages</h5>
          <ul class="link-list">
            <li><a href="#">Press release</a></li>
            <li><a href="#">Terms and conditions</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Career center</a></li>
            <li><a href="#">Contact us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">Latest posts</h5>
          <ul class="link-list">
            <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
            <li><a href="#">Pellentesque et pulvinar enim. Quisque at tempor ligula</a></li>
            <li><a href="#">Natus error sit voluptatem accusantium doloremque</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="widget">
          <h5 class="widgetheading">Flickr photostream</h5>
          <div class="flickr_badge">
            <script type="text/javascript"
                    src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=34178660@N03"></script>
          </div>
          <div class="clear">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <hr>
    </div>
  </div>

  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>
              <span>&copy; Arsha 2014 All right reserved. By </span><a href="http://bootstraptaste.com" target="_blank">Bootstraptaste</a>
            </p>
            <!--
                All links in the footer should remain intact.
                Licenseing information is available at: http://bootstraptaste.com/license/
                You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Arsha
            -->
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="social-network">
            <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus fa-1x"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--end footer-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
{{--<script src="js/jquery.js"></script>--}}
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
{{--<script src="js/bootstrap.min.js"></script>--}}

<script type="text/javascript" src="{{ URL::asset('js/responsive-slider.js') }}"></script>
{{--<script src="js/responsive-slider.js"></script>--}}

<script type="text/javascript" src="{{ URL::asset('js/wow.min.js') }}"></script>
{{--<script src="js/wow.min.js"></script>--}}
<script>
  wow = new WOW(
    {})
  .init();
</script>
<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>

</body>
</html>