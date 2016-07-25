<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Helpdesk - Login Page</title>
    <link rel="stylesheet" href="/asset/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/datepicker/css/datepicker.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/plugins/metisMenu/dist/metisMenu.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/css/sb-admin-2.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/admin/font-awesome/css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/css/style.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/asset/css/login.css" media="screen" title="no title" charset="utf-8">

    <script src="/asset/js/jquery-2.1.4.min.js" charset="utf-8"></script>
    <script src="/asset/js/jquery-ui.min.js" charset="utf-8"></script>
    <script src="/asset/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="/asset/datepicker/js/bootstrap-datepicker.js" charset="utf-8"></script>
 </head>
 <body>
 	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ URL::Route('doLogin')}}" method="POST">
                        	  {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" value="{{ old('email') }}" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </body>
</html>
