<div class="row">
	<div class="col-lg-5">
		<div class="form-group col-lg-12">
          	<label>Name</label>
			<input class="form-control" name="name" type='text' class='validate' placeholder='Team Name' value="{{ $data->name or '' }}"/>
        </div>
        <div class="height10"></div>
        <div class="form-group col-md-12">
        	<label>Description</label>
        	<textarea class="form-control" placeholder='Team Description'  name='description' >{{ $data->description or '' }}</textarea>
        </div>
        <div class="height10"></div>
        <div class="form-group col-md-12">
			<input  type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>			
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group col-md-12">
			<label>Member</label>
			<select id='member' name="member[]" class="form-control" multiple="multiple">
			@if(isset($data->user))

				@foreach($data->user as $users)
					<option value="{{ $users->id }}" selected> {{ $users->name }}</option>
				@endforeach

			@endif				
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
					var $select2Elm = $('#member');
					$select2Elm.select2({
							placeholder: "Select Team Member",
						    tags: true,
						    multiple: true,
						    ajax: {
							    url: "{{URL::route('user::fetch')}}",
							    dataType: 'json',
							    type: "GET",
							    delay: 250,
							    data: function (params) {
							      return {
							        q: params.term, // search term
							        page: params.page
							      };
							    },
							    processResults: function (data, page) {
							      // parse the results into the format expected by Select2.
							      // since we are using custom formatting functions we do not need to
							      // alter the remote JSON data
							      return {
							        results: $.map(data, function (item) {
					                    return {
					                        text: item.label,
					                        id: item.id
					                    }
					                })
							      };
							    },
							    cache: true
							  },
					});
					
				});
			</script> 
		</div>
	</div>
</div>
