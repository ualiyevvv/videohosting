@extends('layouts.app')

@section('content')
<body class="sidebar-collapse">
<!-- Site wrapper -->

<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.nav ')

  @if(isset($_GET['search']))
        @if(count($videos)>0)
            <h3>Результаты поиска по запросу "{{$_GET['search']}}"</h3>
            @if(count($videos)>4)
                <p>Найдено всего {{count($videos)}} постов</p>
                @elseif(count($videos)==1) <p>Найден всего {{count($videos)}} пост</p>
            @else
                <p>Найдено всего {{count($videos)}} поста</p>
            @endif
        @else
            <h2>По запросу "{{htmlspecialchars($_GET['search'])}}"ничего не найдено</h2>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Посмотреть все посты</a>
        @endif
    @endif

  <div class="content-wrapper">
    <section class="content">
    @if(count($videos) > 0)
    <div class="row pt-4">
        @foreach($videos as $video)
        <div class="col-4">
            <div class="card">
                <div class="card-header"><h2>{{$video->caption}}</h2></div>
                <div class="card-body">
                    <div class="card-img" style="background-image: url({{ $post->img ?? asset('img/default.jpg') }})"></div>
                    <div class="card-author">Категория: {{ $video->category->cat_name }}</div>
                    <div class="card-author">Автор: {{ $video->user->nickname }}</div>
                    <div class="card-author">Просмотры: {{ $video->views }}</div>
                    <div class="card-author">Дата: {{ $video->created_at }}</div>
                    <a href="{{ route('video.show', ['id'=>$video->id]) }}" class="btn btn-outline-primary">Посмотреть видео</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>    
    
    {{ $videos->links() }}
    @else
      <p>Видео отсутствуют. Нажмите чтобы загрузить первое видео.</p>
      <a class="btn btn-outline-primary" href="{{ route('video.new') }}">Загрузить видео</a>
    @endif


    @guest
    <a class="newvideo alert-auth" href="#" title = "Загрузить видео" onclick="alert('Зарегистрируйтесь или войдите, чтобы загружать видео')">
      <div class="btn-primary">+</div>
    </a>
    @else
    <a class="newvideo" href="{{ route('video.new') }}" title = "Загрузить видео">
      <div class="btn-primary">+</div>
    </a>
    @endguest

    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>


@endsection