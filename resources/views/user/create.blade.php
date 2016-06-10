@extends('main')

@section('title','Create User')

@section('content')

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">Create User</h1>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
					<form method='POST' action="{{URL::route('user::store')}}" role='form'>
						{!! csrf_field() !!}

						@include('user._form')
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-stripe">
						<thead>
							<tr>
								<td>Username</td>
								<td>Email</td>
								<td>Role</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $user)
								
								<tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									@foreach($user->roles as $roles)
									<td>{{ $roles->display_name }}</td>
									@endforeach
									<td>
										<div class="dropdown">
										  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
											  <!-- Dropdown Structure -->
											  <ul class="dropdown-menu dropdown-menu-right">
											  	<li><a href="{{URL::route('user::edit',['id' => $user->id])}}">Edit User</a></li>
											    <li><a href="{{URL::route('user::editPassword',['id' => $user->id])}}">Change Password</a></li>
											    <li><a href="">View Profile</a></li>
											    <li class="divider"></li>
											    <li><a href="{{URL::route('user::delete',['id' => $user->id])}}">Delete</a></li>
											  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>
@endsection