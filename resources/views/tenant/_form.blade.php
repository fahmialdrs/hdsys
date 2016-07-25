<div class="form-group col-md-12">
	<label>Name</label>
	<input class="form-control" type='text' placeholder='Tenant Name' name='name' value="{{ $data->name or '' }}"/>
</div>
<div class="height10"></div>
<div class="form-group col-md-12">
	<label>Description</label>
	<textarea class="form-control" placeholder='Tenant Description' name='description'>{{ $data->description or '' }}</textarea>
	<div class="height10"></div>
	<input type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>
</div>