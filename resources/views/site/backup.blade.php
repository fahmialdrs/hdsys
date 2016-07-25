@extends('main')

@section('title','Dashboard')

@section('content')

<div id="page-wrapper">
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">Backup & Restore</h1>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<p></p>
			<div class="col-md-12">
        <a class="btn btn-primary btn-lg" href="{{ URL::route('setting::doBackup')}}">Backup</a>
        <a class="btn btn-danger" href="{{ URL::route('setting::restoreLastBackup')}}">Restore Last backup</a>
      </div>
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <td>File Name</td>
              <td>Size</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($files as $file)
              @if($file['name'] == '.gitignore')
                <?php continue;?>
              @endif
              <tr>
                <td>{{$file['name']}}</td>
                <td>{{($file['size']/1000)}} KB</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-danger btn-large" href="{{URL::route('setting::restore',['name' => $file['name']])}}">Restore</a>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="{{URL::route('setting::download',['name' => $file['name']])}}">Download</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{URL::route('setting::deleteFile',['name' => $file['name']])}}">Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
		</div>
</div>
@endsection
