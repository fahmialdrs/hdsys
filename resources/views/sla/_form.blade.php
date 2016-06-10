<div class="row">
	<div class="row">
		<div class="col-lg-5">
			<div class="height10"></div>
			<div class="form-group col-lg-12">
	          	<label>Name</label>
				<input value="{{ $data->name or '' }}" class="form-control" name="name" type='text' placeholder='SLA Name' />
	        </div>
	        <div class="height10"></div>
	        <div class="form-group col-md-12">
	        	<label>Description</label>
	        	<textarea class="form-control" name="description" placeholder='SLA Description'  >{{ $data->description or '' }}</textarea>
	        </div>
	        <div class="height10"></div>
	        <div class="form-group col-md-12">
				<label>Tenant</label>
				<select id='tenant' name="tenant_id" class="form-control">
					@foreach($tenant as $ten)
						<option value="{{$ten->id}}" {{ (isset($data->tenant_id) && $ten->id == $data->tenant_id ) ? 'selected' : '' }}>{{$ten->name}}</option>
					@endforeach	
				</select>
				<script type="text/javascript">
					$(document).ready(function() {
						var $select2Elm = $('#tenant');
						$select2Elm.select2({
								placeholder: "Select Tenant",
						});
						
					});
				</script> 
			</div>
			<div class="height10"></div>
	        <div class="form-group col-md-12">
				<input type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>			
			</div>
		</div>
	</div>
</div>

