@extends('main')
<?php $title='Change User Password'; ?>
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
				<div class="col-lg-6">
					<form method='POST' action="{{URL::route('user::updatePassword',['id'=>$data->id])}}" role='form'>
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name='id' value='{{$data->id}}'>
						<div class="input-group col-md-12">
							<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-user fa-fw'></i></span>
							<input class="form-control" type='text' placeholder='Username' name='name' value="{{ $data->name or '' }}" disabled/>
						</div>
						<div class="height10"></div>
						<div class="input-group col-md-12">
							<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-envelope fa-fw'></i></span>
							<input class="form-control" type='text' placeholder='Email' name='email' value="{{ $data->email or '' }}" disabled/>
						</div>
						<div class="height10"></div>
						<div class="input-group col-md-12">
							@foreach($data->roles as $role)
								<?php $roles = $role->name ?>
							@endforeach
							<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-sitemap  fa-fw'></i></span>
							<select name='role' class="form-control" disabled>
								@if(Auth::user()->hasRole('superAdmin'))
								<option value="admin" {{ ($roles == 'admin')? 'selected' : '' }}>Admin</option>
								@endif
								<option value="mitra" {{ ($roles == 'mitra')? 'selected' : '' }}>Mitra</option>
								<option value="pic" {{ ($roles == 'pic')? 'selected' : '' }}>PIC</option>
							</select>
						</div>
						<div class="height10"></div>
						<div class="input-group col-md-12">
							
							<input class="form-control" type='password' placeholder='New Password' name='password' value="{{ $data->username or '' }}"/>
						</div>
						<div class="height10"></div>
						<div class="input-group col-md-12">
							<input class="form-control" type='password' placeholder='Re Type New Password' name='password_confirmation' value="{{ $data->username or '' }}"/>
						</div>
						<div class="height10"></div>
						<div class="form-group">
							<input  type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
@endsection