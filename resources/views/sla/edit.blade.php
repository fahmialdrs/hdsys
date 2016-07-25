@extends('main')
<?php $title = 'Edit SLA';?>
@section('title',$title)
@section('content')
  

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	        <h1 class="page-header">{{$title}}</h1>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body" >
			<form role="form" method="POST" action="{{ URL::route('sla::update',['id'=>$data->id]) }}">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">

				 @include('sla._form')

			</form>
		</div>
</div>

 
	
@endsection