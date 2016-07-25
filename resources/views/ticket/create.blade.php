@extends('main')
<?php $title = 'Create Ticket';?>
@section('title',$title)
@section('content')
  

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	        <h1 class="page-header">{{$title}}</h1>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<form role="form" action="{{URL::route('ticket::store')}}" method="post">
				{!! csrf_field() !!}

				 @include('ticket._form')

			</form>
		</div>
</div>

 
	
@endsection