<div class="form-group col-md-12">
	<label>Name</label>
	<input class="form-control" type='text' placeholder='Mitra Name' name='name' value="{{ $data->name or '' }}"/>
</div>
<div class="height10"></div>
<div class="form-group col-md-12">
	<label>Email</label>
	<input class="form-control" type='text' placeholder='Mitra Email' name='email' value="{{ $data->email or '' }}"/>
</div>
<div class="height10"></div>
<div class="form-group col-md-12">
	<label>Description</label>
	<textarea class="form-control" placeholder='Mitra Description' name='description'>{{ $data->description or '' }}</textarea>
	<div class="height10"></div>
	<input type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>
</div>