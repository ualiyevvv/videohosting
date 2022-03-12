@extends('layouts.app')

@section('content')
<body class="sidebar-collapse">
<!-- Site wrapper -->

<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.nav ')


  <div class="content-wrapper">
    <section class="content">

    <div class="row pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-img card-img-max">
                  <video src="{{ $video->file }}" controls width="100%"></video>
                </div>
                <div class="card-header"><h1>{{$video->caption}}</h1></div>
            </div>
            <div class="card">
              <div class="card-body">
                  <div class="card-author">Описание: <pre>{{ $video->description }}</pre></div>
                  <div class="card-author">Автор: {{ $video->user->nickname }}</div>
                  <div class="card-author">Категория: {{ $video->category->cat_name }}</div>
                  <div class="card-author">Просмотры: {{ $video->views }}</div>
                  <div class="card-author">Лайки: {{ $video->likes }}</div>
                  <div class="card-author">Дизлайки: {{ $video->dislikes }}</div>
                  <div class="card-date">Пост создан: {{ $video->created_at->diffForHumans()}}</div>
                  <div class="card-btn">
                      <a href="{{ route('video.like', ['id'=>$video->id]) }}"  class="btn btn-outline-secondary like" id="like">Лайк</a>
                      <a href="{{ route('video.dislike', ['id'=>$video->id]) }}" class="btn btn-outline-secondary">Дизлайк</a>
                      @auth
                          @if(Auth::user()->id == $video->user_id)
                      <a href="{{ route('video.edit',['id'=>$video->id]) }}" class="btn btn-outline-success">Редактировать</a>
                      <form action="{{ route('video.delete',['id'=>$video->id]) }}" method="post" onsubmit="if(confirm('Точно удалить пост?')){return true}else{return false}">
                          @csrf
                          @method("DELETE")
                          <input type="submit" class="btn btn-outline-danger" value="Удалить">
                      </form>
                          @endif
                      @endauth
                  </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
              @auth
                  <form action="{{ route('comment.store', [ 'id' => $video->id ]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Оставьте комментарий</label>
                      <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                      <button class="btn btn-outline-secondary" type="submmit" id="button-addon1">Отправить</button>
                    </div>
                  </form>
                  <!--<script>
                    var button = document.getElementById('button-addon1'),
                        xmlhttp = new XMLHttpRequest();
                    button.addEventListener('click', function() {
                    var name = document.getElementById('name').value.replace(/<[^>]+>/g,''),
                        comment = document.getElementById('comment').value.replace(/<[^>]+>/g,'');
                    if(name === '' || comment === '') {
                      alert('Заполните все поля!');
                      return false;
                    }
                    xmlhttp.open('post', 'libs/add_comment.php', true);
                    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("name=" + encodeURIComponent(name) + "&comment=" + encodeURIComponent(comment));
                    });
                  </script>-->
              @else
                <div class="text"><a href="{{ route('user.create') }}">Зарегистрируйтесь</a> или <a href="{{ route('login') }}">войдите</a> чтобы оставлять комментарии</div>
              @endauth

              </div>
              <div class="card-header"><h3>{{ count($comments) }} Комментариев</h3></div>
              <ul class="comments list-group list-group-flush">
              @foreach($comments as $comment)
                <li class="comments__item list-group-item">
                  <div class="comments__info">
                    <span class="comments__item-author"><b>{{ $comment->user->nickname }}</b></span>
                    <span class="comments__item-date">{{ $comment->created_at->diffForHumans() }}</span>
                  </div>  
                  <span class="comments__item-text"><pre>{{ $comment->text }}</pre></span>
                </li>
              @endforeach
              </ul>
            </div>


        </div>

    </div>  

    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>


@endsection