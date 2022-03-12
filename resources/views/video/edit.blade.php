@extends('layouts.app')

@section('content')
<body class="sidebar-collapse">
<!-- Site wrapper -->

<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.nav ')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
  <section class="content pt-4">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">Редактировать видео</h3>
      </div>
      <div class="row">
        <div class="card-body col-3">
            <div class="card-img card-img-max">
              <video src="{{ $video->file }}" controls width="100%"></video>
            </div>
        </div>
        <div class="card-body p-0 col-9">
          <!-- form start -->
          <form action="{{ route('video.update',['id'=>$video->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                  <label for="caption">Caption</label>
                  <input type="caption" class="form-control" name="caption" value="{{ $video->caption }}" id="caption" placeholder="Enter caption">
              </div>
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="10">{{ $video->description }}</textarea>
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" id="category_id" class="custom-select">
                    <option selected="selected" disabled>Выберите категорию</option>
                  @foreach($categories as $category)
                    @if($category->id == $video->category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->cat_name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-outline-danger" href="{{ url()->previous() }}">Отменить</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.row -->
  </div><!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>


@endsection



