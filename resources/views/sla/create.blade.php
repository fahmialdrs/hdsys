@extends('main')
<?php $title = 'Create SLA';?>
@section('title',$title)
@section('content')
  

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	        <h1 class="page-header">{{$title}}</h1>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body" >
			<form role="form" method="POST" action="{{ URL::route('sla::store') }}">
				{!! csrf_field() !!}
				@include('sla._form')

			</form>
		</div>
</div>

 
	
@endsection