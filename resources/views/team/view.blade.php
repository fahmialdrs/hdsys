@extends('main')
<?php $title = 'View Details Team #'.$data->id;?>
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
							  <!-- Dropdown Structure -->
							  <ul class="dropdown-menu dropdown-menu-right">
							    <li><a href="{{ URL::route('team::edit',['id' => $data->id ]) }}">Edit Team Name</a></li>
							    <li class="divider"></li>
							    <li><a href="{{ URL::route('team::delete',['id' => $data->id ]) }}">Delete</a></li>
							  </ul>
						</div>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<div class='row'>
				<div class='col-md-10'>
					<h2><a class='' href='#'>{{ $data->name }}</a></h2>
					<p class='text-lighten-4'>{{ $data->description }}</p>
				</div>
				<div class='col-md-2 pull-right'>
					
				</div>
			</div>
			<div class='row'>
			 <div class="panel panel-default">
				 <div class="panel-heading">Team Member</div>
				  	<div class="panel-body">
						<div class='row'>
							<div class='col-md-4'>
							  	<table class="table table-striped">
							  		<thead>
							  			<tr>
											<th>Id</th>
							  				<th>Name</th>
							  				<th>Email</th>
							  			</tr>
							  		</thead>
							  		<tbody>
											@foreach($data->user as $users)
												<tr>
													<td>{{ $users->id }} </td>
													<td>{{ $users->name }}</td>
													<td>{{ $users->email }}</td>
												</tr>
											@endforeach
							  		</tbody>
							  	</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection