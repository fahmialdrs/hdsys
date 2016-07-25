@extends('main')
<?php $title = 'View Team';?>
@section('title',$title)
@section('content')
<div id="page-wrapper">
    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<a class="rightButton pull-right" href='{{ URL::route("team::add") }}'>
					<button class="btn btn-primary" >
						Create New Team
					</button>
				</a>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
				 {!! $data->render() !!}
			</div>
		</div>
		<div class='row'>
			 <div class="col-md-7">
				 <table class="table table-striped">
			        <thead>
			          <tr>
			              <th>Name</th>
			              <th>Description</th>
			              <th></th>
			          </tr>
			        </thead>
					<?php //var_dump($data); ?>
			        <tbody>
			        	@foreach($data as $team)
			          <tr>
			            <td>{{ $team->name }}</td>

			            <td>{{ $team->description }}</td>
			            <td>
			            <div class="dropdown">
						  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
							  <!-- Dropdown Structure -->
							  <ul class="dropdown-menu dropdown-menu-right">
							    <li><a href="{{ URL::route('team::edit',['id' => $team->id ]) }}">Edit</a></li>
							    <li><a href="{{ URL::route('team::view',['id' => $team->id ]) }}">View Details</a></li>
							    <li class="divider"></li>
							    <li><a href="{{ URL::route('team::delete',['id' => $team->id ]) }}">Delete</a></li>
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
				 {!! $data->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection