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
          <div class="card-header">
            <h3 class="card-title">Мои видео</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
        <div class="card-body">
          
        
        @if(count($videos) > 0)
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Project Name
                    </th>
                    <th style="width: 8%" class="text-center">
                        File
                    </th>
                    <th style="width: 8%" class="text-center">
                        Description
                    </th>
                    <th style="width: 8%" class="text-center">
                        Likes
                    </th>
                    <th style="width: 8%" class="text-center">
                        Dislikes
                    </th>
                    <th style="width: 8%" class="text-center">
                        Category
                    </th>
                    <th style="width: 8%" class="text-center">
                        Status
                    </th>
                    <th style="width: 8%" class="text-center">
                        date
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
        @foreach($videos as $video)
        
                <tr>
                    <td>
                        {{ $video->id }}
                    </td>
                    <td>
                        {{ $video->caption }}
                    </td>
                    <td class="project-state">
                        <video src="{{ $video->file }}" alt="{{ $video->caption }}" width="200" controls></video> 
                    </td>
                    <td class="project">
                        {{ $video->description }}
                    </td>
                    <td class="project-state">
                        {{ $video->likes }}
                    </td>
                    <td class="project-state">
                        {{ $video->dislikes }}
                    </td>
                    <td class="project-state">
                        {{ $video->category->cat_name }}
                    </td>
                    <td class="project-state">
                      @if( $video->strike->id==1 )
                        <span class="badge badge-success">{{ $video->strike->strike_name }}</span>
                      @elseif( $video->strike->id==2 )
                        <span class="badge badge-warning">{{ $video->strike->strike_name }}</span>
                      @elseif( $video->strike->id==3 )
                        <span class="badge badge-secondary">{{ $video->strike->strike_name }}</span>
                      @elseif( $video->strike->id==4 )
                        <span class="badge badge-danger">{{ $video->strike->strike_name }}</span>
                      @endif
                    </td>
                    <td class="project-state">
                        {{ $video->created_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{ route('video.edit', ['id'=>$video->id]) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{ route('video.delete', ['id'=>$video->id]) }}">
                            <i class="fas fa-trash">
                            </i>
                        </a>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
        @else
          <p>У вас нет загруженных видео. Нажмите чтобы загрузить свое первое видео.</p>
          <a class="btn btn-outline-primary" href="{{ route('video.new') }}">Загрузить видео</a>
        @endif

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>


@endsection