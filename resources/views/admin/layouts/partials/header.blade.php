
<header id="main-header">
  <nav id="header-nav" class="navbar navbar-default">
    <div class="navbar-header">

      <a class="navbar-brand" href="/">

      </a>

    </div>
    <a class="logout" href="{{ route('logout') }}"
         onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                                        {{ __('تسجيل الخروج') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </nav>


</header>

