@extends('main')
<?php $title = 'Edit Ticket #'.$data->id;?>
@section('title',$title)
@section('content')
  

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	        <h1 class="page-header">{{$title}}</h1>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<form role="form" action="{{URL::route('ticket::update',['id'=>$data->id])}}" method="post">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">

				 @include('ticket._form')

			</form>
		</div>
</div>

 
	
@endsection