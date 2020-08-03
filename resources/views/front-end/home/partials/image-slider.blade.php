<div id="homeCarouselIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
  <ol class="carousel-indicators">
    <?php $i=0 ?>
    @foreach($carousels as $carousel)
    <li data-target="#homeCarouselIndicators" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></li>
    <?php $i= $i+1 ?>
    @endforeach
  </ol>
  <div class="carousel-inner" role="listbox">

    @foreach($carousels  as $carousel)
    <!--- Slides -->
    <div class="carousel-item {{$carousel->order == 1 ? 'active' : ''}}" style="background-image: url({{ $carousel->src }})">
      <div class="carousel-caption text-right">
        <h1>تركي هوم</h1>
        <h3>المدرسة الألكترونية الأفضل</h3>
        <a class="btn btn-primary btn1-carousel" href="{{ route('register') }}">إنشاء حساب</a>
        <a class="btn btn-danger btn2-carousel" href="{{ route('login') }}">تسجيل الدخول</a>
      </div>
    </div>
    @endforeach

  </div>
</div>





   