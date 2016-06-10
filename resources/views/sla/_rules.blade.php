<tr>
	<td>
		<input type="hidden" value="{{ $data->id }}" name='sla_id'>
		<select class="form-control" name="type">
				<option value="respond">Respond</option>
				<option value="recover">Recover</option>
				<option value="resolve">Resolve</option>
			</select>
		</td>
	<td><input class="form-control" name="name" type='text' class='validate' placeholder='Name'/></td>
	<td>
		<div id="datetimepicker3" class="input-group input-append">
		    <input class="form-control" name="min_time" placeholder='Minimum Time' data-format="hh:mm:ss" type="text"></input>
		    <span class="input-group-addon add-on">
		      <i class='glyphicon glyphicon-time' data-time-icon="icon-time" data-date-icon="icon-calendar">
		      </i>
		    </span>
		  </div>
		  <script type="text/javascript">
			  $(function() {
			    $('#datetimepicker3').datetimepicker({
			      pickDate: false,
			      defaultTime: false
			    });
			  });
			</script>
	</td>
	<td><input  type='submit' value="Add SLA Rules" class='btn btn-primary'></td>
</tr>