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
          <h3 class="card-title">Подтверждение почты</h3>
      </div>
      <div class="row">        
        <div class="card-body col-12 text-center">
            <h2>Проверьте почту (логи)</h2>
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



