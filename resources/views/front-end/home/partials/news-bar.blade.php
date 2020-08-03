<!-- <div class="container-fluid news-bar padding-section" style="color: #777;">
  <div class="text-center" style="margin-bottom:20px;">
      <h1>أخبارُنا</h1>
  </div>  
  <div class="slideUp" id="news-bar">
    <marquee direction="right" scrollamount="3" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
      <a href="#" class="hvr-pop">الخبر الاول</a><a> -*- </a>
      <a href="#" class="hvr-pop">الخبر الثاني</a><a> -*- </a>
      <a href="#" class="hvr-pop">الخبر الثالث</a><a> -*- </a>
      <a href="#" class="hvr-pop">الخبر الرابع</a><a> -*- </a>
      <a href="#" class="hvr-pop">الخبر الخامس</a><a> -*- </a>
    </marquee>
  </div>
</div> -->



<div class="slideUp" id="news-bar" style="Background:#C81C0C;">
    <marquee direction="right" scrollamount="3" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
      @foreach($notes as $note)
      <a href="#" class="hvr-pop">{{$note->content}}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      @endforeach
    </marquee>
  </div>