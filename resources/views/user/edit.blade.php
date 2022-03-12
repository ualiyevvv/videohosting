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
          <h3 class="card-title">Настройки аккаунта</h3>
      </div>
      <div class="row">
        <div class="card-body col-5">
          <!-- form start -->
          <h4>Изменить пароль</h4>
          <form action="{{ route('user.change.password',['id'=>Auth::user()->id]) }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                  <label for="password_old">Введите старый пароль</label>
                  <input type="text" class="form-control" name="password_old" value="" id="password_old" placeholder="Enter old password">
              </div>
              <div class="form-group">
                  <label for="password">Введите новый пароль</label>
                  <input type="text" class="form-control" name="password" value="" id="password" placeholder="Enter new password">
              </div>
              <div class="form-group">
                  <label for="password_confirmation">Повторите новый пароль</label>
                  <input type="text" class="form-control" name="password_confirmation" value="" id="password_confirmation" placeholder="Retype new password">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-outline-danger" href="{{ url()->previous() }}">Отменить</a>
              </div>
            </div>
          </form>
        </div>

        
        <div class="card-body col-7">
          <h4>Активные сессии</h4>
          @if(count($sessions) > 0)
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 25%" class="text-center">
                          ip address
                      </th>
                      <th style="width: 40%" class="text-center">
                          user agent
                      </th>
                      <th style="width: 30%" class="text-center">
                          last activity
                      </th>
                  </tr>
              </thead>
              <tbody>
          @foreach($sessions as $session)
                  <tr>
                      <td class="project-state">
                        {{ $session->ip_address }}
                      </td>
                      <td class="project">
                        {{ $session->user_agent }}
                      </td>
                      @if(Session::getId() == $session->id)
                        <td class="project-state alert-success">
                        {{ date("Y-m-d H:i:s", $session->last_activity) }}, <br>
                          Текущая сессия
                        </td>
                      @else 
                        <td class="project-state">
                          {{ date("Y-m-d H:i:s", $session->last_activity) }} <br> <a class="" href="{{ route('session.delete',['id'=>$session->id]) }}">выход</a>
                        </td>
                      @endif
                  </tr>
          @endforeach
              </tbody>
          </table>
          @else
            <p>У вас нет активных сессий</p>
          @endif

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



