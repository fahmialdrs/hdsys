
	
		<div class="input-group col-md-12">
			<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-user fa-fw'></i></span>
			<input class="form-control" type='text' placeholder='Username' name='name' value="{{ $data->username or '' }}"/>
		</div>
		<div class="height10"></div>
		<div class="input-group col-md-12">
			<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-envelope fa-fw'></i></span>
			<input class="form-control" type='text' placeholder='Email' name='email' value="{{ $data->username or '' }}"/>
		</div>
		<div class="height10"></div>
		<div class="input-group col-md-12">
			<span class="input-group-addon" id="sizing-addon1"><i class='fa fa-sitemap  fa-fw'></i></span>
			<select name='role' class="form-control">
				@if(Auth::user()->hasRole('superAdmin'))
				<option value="admin">Admin</option>
				@endif
				<option value="pic">PIC</option>
			</select>
		</div>
		<div class="height10"></div>
		<div class="input-group col-md-12">
			
			<input class="form-control" type='password' placeholder='Password' name='password' value="{{ $data->username or '' }}"/>
		</div>
		<div class="height10"></div>
		<div class="input-group col-md-12">
			<input class="form-control" type='password' placeholder='Re Type Password' name='password_confirmation' value="{{ $data->username or '' }}"/>
		</div>
		<div class="height10"></div>
		<div class="form-group">
			<input  type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>
		</div>
