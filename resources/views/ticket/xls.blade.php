<!DOCTYPE html>
<html>
<head>
	<title>Helpdesk System Export</title>
</head>
<body>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>title</th>
			<th>description</th>
			<th>status</th>
			<th>priority</th>
			<th>severity</th>
			<th>Assign</th>
			<th>create_at</th>
			<th>update_at</th>
			<th>respond_at</th>
			<th>recover_at</th>
			<th>resolve_at</th>
			<th>close_at</th>
			<th>penalty</th>
			<th>category</th>
			<th>user</th>
			<th>Tower</th>
			<th>SLA</th>
			<th>Mitra</th>
			<th>Full Name</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $export)
		<tr>
			<td>{{$export->id}}</td>
			<td>{{$export->title}}</td>
			<td>{{$export->description}}</td>
			<td>{{$export->status}}</td>
			<td>{{$export->priority}}</td>
			<td>{{$export->severity}}</td>
			@if($export->assign_type == 'team')
				<td>{{$export->assign->display_name}}</td>
			@else
				<td>{{$export->assign->name}}</td>
			@endif
			<td>{{$export->created_at}}</td>
			<td>{{$export->updated_at}}</td>
			<td>{{$export->respond_at}}</td>
			<td>{{$export->recover_at}}</td>
			<td>{{$export->resolve_at}}</td>
			<td>{{$export->close_at}}</td>
			<td>
				@foreach($export->sla->rules as $rules)
					@if($rules->name == $export->severity)

						{{$rules->type}} :
						{{$rules->name}} :
						{{$rules->min_time->format('H:i:s')}} :

							@if(isset($export->respond_at) && $rules->type == 'respond')
									{{gmdate('H:i:s',$export->respond_at->diffInSeconds($export->created_at))}}

									( {{$export->respond_at->diffForHumans($export->created_at)}} )
							@elseif(isset($export->recover_at) && $rules->type == 'recover')
									{{gmdate('H:i:s',$export->recover_at->diffInSeconds($export->respond_at))}}

									( {{$export->recover_at->diffForHumans($export->respond_at)}} )
							@elseif(isset($data->resolve_at) && $rules->type == 'resolve')
									{{gmdate('H:i:s',$export->resolve_at->diffInSeconds($data->recover_at))}}

									( {{$export->resolve_at->diffForHumans($export->recover_at)}} )
							@endif
							:
							<?php 
								$hour = $rules->min_time->hour * 3600;
								$minute = $rules->min_time->minute * 60;
								$second = $hour + $minute + $rules->min_time->second;
							?>
							@if(isset($data->respond_at) && $rules->type == 'respond')
								<?php 
									$process = $data->respond_at->diffInSeconds($data->created_at);
									$penalty = $second - $process;
								?>
								@if($process > $second)
									{{gmdate('H:i:s',abs($penalty))}}
								@endif

								
							@elseif(isset($data->recover_at) && $rules->type == 'recover')
								<?php 
									$process = $data->recover_at->diffInSeconds($data->respond_at);
									$penalty = $second - $process;
								?>
								@if($process > $second)
									{{gmdate('H:i:s',abs($penalty))}}
								@endif

								
							@elseif(isset($data->resolve_at) && $rules->type == 'resolve')
								<?php 
									$process = $data->resolve_at->diffInSeconds($data->recover_at);
									$penalty = $second - $process;
								?>
								@if($process > $second)
									{{gmdate('H:i:s',abs($penalty))}}
								@endif

								
								<!-- {{($rules->min_time->hour-abs($data->resolve_at->hour-$data->recover_at->hour))  }} hour,
								{{($rules->min_time->minute-abs($data->resolve_at->minute-$data->recover_at->minute))  }} minute,
								{{($rules->min_time->second-abs($data->resolve_at->second-$data->recover_at->second))  }} second -->
							@endif
						<br/>
					@endif
				@endforeach
			</td>
			<td>{{$export->category->name}}</td>
			<td>{{$export->user->name}}</td>
			<td>{{$export->tower->name}}</td>
			<td>{{$export->mitra->name}}</td>
			<td>{{$export->sla->name}}</td>
			<td>{{$export->full_name}}</td>
			<td>{{$export->email}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>