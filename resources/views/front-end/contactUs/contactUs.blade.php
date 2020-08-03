@extends('front-end.layouts.master')

@section('content')
<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-color:#212121; height: 240px;" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  
</header>

<div id="fh5co-contact">
  <div class="container">
    <div class="row">
      <div class="col-md-11 col-md-push-1 animate-box">
        
        <div class="fh5co-contact-info" style="text-align: right;">
          <h2> للتواصل معنا </h2>
          <ul>
            {{-- <li class="address">198 West 21th Street, <br> Suite 721 New York NY 10016</li> --}}
            <li class="phone"><a style="font-size: 19px" href="tel://1234567920">05522568343</a></li>
            <li class="email"><a style="font-size: 19px" href="mailto:info@yoursite.com">turkeyhome.rim@gmail.com</a></li>
            {{-- <li class="url"><a href="http://gettemplates.co">gettemplates.co</a></li> --}}
          </ul>
        </div>

      </div>
      
      
    </div>
    
  </div>
</div>


@endsection