<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Helpdesk - @yield('title')</title>
    <link rel="stylesheet" href="/asset/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/timepicker/css/bootstrap-datetimepicker.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/plugins/metisMenu/dist/metisMenu.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/css/sb-admin-2.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/font-awesome/css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/select2/css/select2.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/css/style.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <script src="/asset/js/jquery-2.1.4.min.js" charset="utf-8"></script>
    <script src="/asset/js/jquery-ui.min.js" charset="utf-8"></script>
    <script src="/asset/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="/asset/timepicker/js/bootstrap-datetimepicker.min.js" charset="utf-8"></script>
    <script src="/asset/select2/js/select2.min.js" charset="utf-8"></script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url ('/dashboard') }}">
            Helpdesk System
          </a>

      </div>
      <!-- /.navbar-header -->

      <ul class="nav navbar-top-links navbar-right">
          <!-- /.dropdown -->
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                  <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                  </li>
                  <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="{{ url ('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                  </li>
              </ul>
              <!-- /.dropdown-user -->
          </li>
      </ul>
      <div class="navbar-default sidebar" role="navigation">
              @include('sideMenu')
      </div>
    </nav>
    <div class="messageWrapper">
          @include('message')
    </div>
      @yield('content')
      <!-- <footer class="page-footer">
            @include('footer')
      </footer> -->

    <script src="/asset/admin/plugins/metisMenu/dist/metisMenu.min.js" charset="utf-8"></script>
   <script src="/asset/admin/js/sb-admin-2.js" charset="utf-8"></script>
   @stack('script');
  </body>
</html>
