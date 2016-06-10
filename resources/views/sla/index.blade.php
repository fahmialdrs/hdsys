@extends('main')
<?php $title = 'View All SLA';?>
@section('title',$title)
@section('content')
<div id="page-wrapper">
    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<a class="rightButton pull-right" href='{{ URL::route("sla::add") }}'>
					<button class="btn btn-primary" >
						Create New SLA
					</button>
				</a>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
			</div>
		</div>
		<div class='row'>
			 <div class="col-md-12">
				 <table class="table table-striped">
			        <thead>
			          <tr>
			              <th>Name</th>
			              <th>Description</th>
			              <th>Respond</th>
			              <th>Recover</th>
			              <th>Resolve</th>
			              <th></th>
			          </tr>
			        </thead>
					<?php //var_dump($data); ?>
			        <tbody>
			        	@foreach($data as $sla)
			          <tr>
			            <td>{{$sla->name}}</td>

			            <td>{{$sla->description}}</td>
		            	<td>
		            		<ul class="list-group">
		            			 @foreach($sla->rules as $rules)
		            				@if($rules->type == 'respond')
			            				<li class="list-group-item">{{ $rules->name }} < {{ $rules->min_time->format('H:i:s') }}</li>
			            			@endif
			            		@endforeach
			            	</ul>
		            	</td>
		            	<td>
		            		<ul>
		            			 @foreach($sla->rules as $rules)
		            				@if($rules->type == 'recover')
			            				<li class="list-group-item">{{ $rules->name }} < {{ $rules->min_time->format('H:i:s') }}</li>
			            			@endif
			            		@endforeach
			            	</ul>
		            	</td>
		            	<td>
		            		<ul>
		            			 @foreach($sla->rules as $rules)
		            				@if($rules->type == 'resolve')
			            				<li class="list-group-item">{{ $rules->name }} < {{ $rules->min_time->format('H:i:s') }}</li>
			            			@endif
			            		@endforeach
			            	</ul>
		            	</td>
			           
			            
			            <td>
			            <div class="dropdown">
						  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
							  <!-- Dropdown Structure -->
							  <ul class="dropdown-menu dropdown-menu-right">
							    <li><a href="{{URL::route('sla::edit',['id' => $sla->id])}}">Edit</a></li>
							    <li><a href="{{URL::route('sla::rules',['id' => $sla->id])}}">Edit Rules</a></li>

							    <li><a href="#">View Details</a></li>
							    <li class="divider"></li>
							    <li><a href="{{URL::route('sla::delete',['id' => $sla->id])}}">Delete</a></li>
							  </ul>
						</div>
			            </td>
			          </tr>
			         @endforeach
			        </tbody>
			      </table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 pull-right">
			</div>
		</div>
	</div>
</div>
@endsection