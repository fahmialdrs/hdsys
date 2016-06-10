@extends('main')
<?php $title = 'Create Category' ?>
@section('title',$title)

@section('content')

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-5">
					<form method='POST' action="{{URL::route('category::store')}}" role='form'>
						{!! csrf_field() !!}

						@include('category._form')
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
							@foreach($data as $category)
								
								<tr>
									<td>{{ $category->name }}</td>
									<td>{{ $category->description }}</td>
									<td>
										<div class="dropdown">
										  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
											  <!-- Dropdown Structure -->
											  <ul class="dropdown-menu dropdown-menu-right">
											  	<li><a href="{{URL::route('category::edit',['id' => $category->id])}}">Edit</a></li>
											    <li class="divider"></li>
											    <li><a href="{{URL::route('category::delete',['id' => $category->id])}}">Delete</a></li>
											  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $data->render() !!}
				</div>
			</div>
		</div>
</div>
@endsection