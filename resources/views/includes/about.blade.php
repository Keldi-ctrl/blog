
<div class="container">
  <div class="about">
    <div class="row">
      <div class="recent">
        <button class="btn-primarys"><h3>{{ $decodeJson['about_us'] }}</h3></button>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="row-slider">
        <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
          <div class="col-lg-6 mar-bot30">
            <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
              <div class="slides" data-group="slides">
                <ul>
                  <div class="slide-bodys" data-group="slide">
                    <li><img alt="" class="img-responsive" src="{{ asset('img/3.jpg') }}" width="100%" height="450"/>
                    </li>
                    <li><img alt="" class="img-responsive" src="{{ asset('img/4.jpg') }}" width="100%" height="450"/>
                    </li>
                    <li><img alt="" class="img-responsive" src="{{ asset('img/4.jpg') }}" width="100%" height="450"/>
                    </li>
                  </div>
                </ul>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
            <div class="thumnails">
              <h4>Voluptatem accusantium doloremque</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                quis nostrud exerci tation ullamcorper suscipit
                lobortis nisl ut aliquip ex ea commodo consequat.</p>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                quis nostrud exerci tation ullamcorper suscipit
                lobortis nisl ut aliquip ex ea commodo consequat.</p>

              <div class="ficon">
                <a href="" alt="">Learn more</a> <i class="fa fa-long-arrow-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>