<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      @if($_SERVER['REQUEST_URI'] == '/video')
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @endif
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Главная</a>
      </li>
      
       
    </ul>

    <ul class="navbar-nav ml-auto">

            <li class="nav-item d-none d-sm-inline-block">
            <form class="form-inline my-2 my-lg-0" action=" {{route('home')}}">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Найти..." aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
            </li>
<!-- Authentication Links -->
@guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
          </li>
          @if (Route::has('login'))
              <li class="nav_token-item">
                  <a class="nav-link" href="{{ route('user.create') }}">{{ __('Регистрация') }}</a>
              </li>
          @endif
      @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.videos',['nickname' => Auth::user()->nickname]) }}">Мои видео</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.setting') }}">Настройки</a>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nickname }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @if(Auth::user()->is_admin == 1)
                    <li>
                        <a class="dropdown-item" href="{{ route('video.list') }}">админка</a>
                    </li>
                    @endif
                </ul>
            </li>
      @endguest
    </ul>
  </nav>
  <!-- /.navbar -->