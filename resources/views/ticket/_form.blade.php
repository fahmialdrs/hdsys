<div class="row">
	<div class="col-lg-8">
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Site</label>
			<select id='tower' name="tower_id" class="form-control" placeholder='assign to team or user'>
				@if(isset($data->tower_id))
					<option value="{{$data->tower->id}}" selected>{{$data->tower->name}}</option>
				@endif
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
					var $select2Elm = $('#tower');
					$select2Elm.select2({
							placeholder: "Select Tower",
						    ajax: {
							    url: "{{URL::route('tower::fetch')}}",
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
					                    	address: item.address,
					                        text: item.name,
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
		<div class="form-group col-lg-12">
          	<label>Issuer Name</label>
			<input class="form-control" name="full_name" type='text' class='validate' placeholder='Full Name' value="{{ $data->full_name or '' }}"/>
        </div>
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Issuer Email</label>
			<input class="form-control" name="email" type='text' class='validate' placeholder='Email Address' value="{{ $data->email or '' }}"/>
        </div>
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Summary</label>
			<input class="form-control" name="title" type='text' class='validate' placeholder='Ticket Summary' value="{{ $data->title or '' }}"/>
        </div>
        <div class="form-group col-md-12">
        	<label>Description</label>
        	<textarea class="form-control" placeholder='Ticket Description'  name='description' >{{ $data->description or '' }}</textarea>
        </div>
				@if(isset($data->pic_status))
					<div class="form-group col-md-12">
						<label>PIC Status Ticket</label>
						<input type="text" class="form-control" id="disabledInput" placeholder='PIC Status Ticket'  name='picStatus' value="{{ $data->pic_status}}" disabled />
					</div>
				@endif


		<div class="height10"></div>
        <div class="form-group col-md-12">
			<input  type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>
		</div>

	</div>
	<div class="col-md-4">
		<div class="height10"></div>
		<div class="form-group col-md-12">
			<label>Assign type</label>
			<div>
				<div class="radio-inline">
				  <label>
				    <input name="assign_type" value='team' type="radio" id="team" {{ isset($data->assign_type) && $data->assign_type == 'team' ? 'checked' : '' }}/>
				    Team
				  </label>
				</div>
				<div class="radio-inline">
				  <label>
				   <input name="assign_type" value='user' type="radio" id="user" {{ isset($data->assign_type) && $data->assign_type == 'user' ? 'checked' : '' }}/>
				    PIC
				  </label>
				</div>
			</div>
			<input type="hidden" id='url' value="{{ isset($data->assign_type) && $data->assign_type == 'team' ? URL::route('team::fetch') : URL::route('user::fetch') }}">
		</div>
		<div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Assign To</label>
			<select id='member' name="assign_id" class="form-control" placeholder='assign to team or user'>
				@if(isset($data->assign_id))
						<option value="{{$data->assign_id}}" selected>{{$data->assign->name}}</option>
				@endif
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
					$('input:radio[name="assign_type"]').change(
					    function(){
					        if ($(this).is(':checked') && $(this).val() == 'user') {
					        	$('#url').val("{{ URL::route('user::fetch') }}");
					        }
					        else if ($(this).is(':checked') && $(this).val() == 'team') {

					        	$('#url').val("{{ URL::route('team::fetch') }}");
					        }
					    });

					var $select2Elm = $('#member');
					$select2Elm.select2({
							placeholder: "Assign Team or User",
						    ajax: {
							    url: function(){
							    	var value = $('#url').val()
							    	return value;
							    },
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
		<div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Priority</label>
			<select id='tenant5' name="priority" class="form-control">
				<option value="low" {{ isset($data->priority) && $data->priority == 'low' ? 'selected' : '' }}> Low</option>
				<option value="normal" {{ isset($data->priority) && $data->priority == 'normal' ? 'selected' : '' }}> Normal</option>
				<option value="high" {{ isset($data->priority) && $data->priority == 'high' ? 'selected' : '' }}> High</option>
				<option value="emergency" {{ isset($data->priority) && $data->priority == 'emergency' ? 'selected' : '' }}> Emergency</option>
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
				  $("#tenant5").select2();
				});
			</script>
        </div>
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>SLA Plan</label>
			<select id='sla' name="sla_id" class="form-control" placeholder="Select SLA">
				@foreach($sla as $slas)
					<option value="{{$slas->id}}">{{$slas->name}}</option>
				@endforeach
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
				 var $select2Elm = $('#sla');
					$select2Elm.select2();
				});
			</script>
        </div>
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Severity</label>
			<select id='severity' name="severity" class="form-control">
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
				  var $select2Elm = $('#severity');
					$select2Elm.select2({
							placeholder: "Select Severity",
						    ajax: {
							    url: function(){
							    	var value = $('#sla').val();
							    	var url = "/sla/fetchSeverity/"+value;
							    	console.log(url);
							    	return url;
							    },
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
					                        text: item.name,
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
		<div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Ticket Category</label>
			<select id='category' name="category_id" class="form-control">
				@foreach($category as $categories)
					<option value="{{$categories->id}}" {{(isset($data->category_id) && $data->category_id == $categories->id ) ? 'selected' : ''}}>{{$categories->name}}</option>
				@endforeach
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
				  $("#category").select2();
				});
			</script>
        </div>
        <div class="height10"></div>
        <div class="form-group col-lg-12">
          	<label>Mitra </label>
			<select id='mitra' name="mitra_id" class="form-control">
				@if(isset($data->mitra_id))
						<option value="{{$data->mitra_id}}" selected>{{$data->mitra->name}}</option>
				@endif
			</select>
			<script type="text/javascript">
				$(document).ready(function() {
				  var $select2Elm = $('#mitra');
					$select2Elm.select2({
							placeholder: "Select Mitra",
						    ajax: {
							    url: "{{ URL::route('mitra::fetch') }}",
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
					                        text: item.name,
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
        <div class="height10"></div>
        <!-- <div class="form-group col-lg-12">
          	<label>Due Date</label>
          	<div id="datetimepicker" class="input-group input-append date">
        			    <input class="form-control" value="{{ $data->due_date or '' }}" placeholder='Due Date' name="due_date" type="text"></input>
        			    <span class="input-group-addon add-on">
        			      <i class='glyphicon glyphicon-calendar' data-time-icon="icon-time" data-date-icon="icon-calendar">
        			      </i>
        			    </span>
        			</div>
        			<script type="text/javascript">
        				$(function() {
        					$('#datetimepicker').datetimepicker({
        						 format: 'yyyy-MM-dd',
        						  pickTime: false
        					});
        				});
        			</script>
        </div> -->
	</div>
</div>
</div>
