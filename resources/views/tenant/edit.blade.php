@extends('main')
<?php $title = 'Edit Tenant #'.$data->id; ?>
@section('title',$title)

@section('content')

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<div class="dropdown pull-right rightButton">
				  <a class='btn-primary btn' href="{{URL::route('tenant::add')}}" type="button">Create New Tenant</a>
				</div>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-5">
					<form method='POST' action="{{URL::route('tenant::update',['id'=>$data->id])}}" role='form'>
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="PUT">
						@include('tenant._form')
					</form>
				</div>
				<div class="col-lg-7">
					<table class="table table-stripe">
						<thead>
							<tr>
								<td>Name</td>
								<td>Description</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($datas as $tenant)
								<tr>
									<td>{{ $tenant->name }}</td>
									<td>{{ $tenant->description }}</td>
									<td>
										<div class="dropdown">
										  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
											  <!-- Dropdown Structure -->
											  <ul class="dropdown-menu dropdown-menu-right">
											  	<li><a href="{{URL::route('tenant::edit',['id' => $tenant->id])}}">Edit</a></li>
											    <li class="divider"></li>
											    <li><a href="{{URL::route('tenant::delete',['id' => $tenant->id])}}">Delete</a></li>
											  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $datas->render() !!}
				</div>
			</div>
		</div>
</div>
@endsection