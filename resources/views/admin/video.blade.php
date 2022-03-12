@extends('layouts.app')

@section('content')
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->

<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.nav ')
  @include('layouts.aside ')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Видео</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Видео</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        

    <div class="row">
        <a href="{{ route('video.new') }}"><button class="btn btn-primary">Добавить видео</button></a>
    </div>

      <!-- Default box -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Все видео</h3>

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
                        Author
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
                    <td class="project-state">
                        {{ $video->user->nickname }}
                    </td>
                    <td class="project-state">
                        {{ $video->category->cat_name }}
                    </td>
                    <td class="project-state">
                      @if( $video->strike->id==1 )
                        <span class="badge badge-success dropdown">{{ $video->strike->strike_name }}</span>
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
                        <a class="btn btn-info btn-sm" href="{{ route('admin.video.edit', ['id'=>$video->id]) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{ route('video.delete', ['id'=>$video->id]) }}" onclick="if(confirm('Точно удалить видео?')){return true}else{return false}">
                            <i class="fas fa-trash">
                            </i>
                        </a>
                    </td>
                </tr>
            
        @endforeach
        {{ $videos->links() }}

            </tbody>
        </table>
        @else
            <p>видео пока нет</p>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@endsection