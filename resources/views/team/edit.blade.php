@extends('main')
<?php $title = 'Edit Team #'.$data->id;?>
@section('title',$title)
@section('content')

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<div class="btn-group rightButton pull-right">
				 	<a class="btn btn-primary" href="{{ URL::route('team::add') }}">Create New Team</a>
				  	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Action <span class="caret"></span>
				    	<span class="sr-only">Toggle Dropdown</span>
				 	</button>
				  <ul class="dropdown-menu">
				    <li><a href="{{ URL::route('team::view',['id' => $data->id ]) }}">View Details</a></li>
				    <li role="separator" class="divider"></li>
				    <li><a href="{{ URL::route('team::delete',['id' => $data->id ]) }}">Delete</a></li>
				  </ul>
				</div>
				<div class="btn-group " role="group" aria-label="...">
				  
				  
				  
				</div>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<form role="form" action="{{ URL::route('team::update',['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">
             	<input type="hidden" name="id" value="{{ $data->id }}">
				 @include('team._form')

			</form>
		</div>
</div>
@endsection