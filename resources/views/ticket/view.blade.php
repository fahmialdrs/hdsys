@extends('main')
<?php $title = 'View Details Ticket';?>
@section('title',$title)
@section('content')
<div id="page-wrapper">
    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<div class="rightButton pull-right">
					<div class='btn-group' role="group">
						<a class="btn btn-primary" href='{{ URL::route("ticket::add") }}'>
							Create New Ticket
						</a>
						<div class="btn-group" role='group'>
						  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
							  <!-- Dropdown Structure -->
							  <ul class="dropdown-menu dropdown-menu-right">
							    <li><a href="{{ URL::route('ticket::edit',['id' => $data->id ]) }}">Edit</a></li>
							    <li><a href="{{ URL::route('ticket::view',['id' => $data->id ]) }}">View Details</a></li>
							    <li><a href="{{ URL::route('ticket::generate',['id' => $data->id ]) }}">View Permit Letter</a></li>
							    <li class="divider"></li>
							    <li class="dropdown-header">Change Status To</li>
							    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $data->id,'status'=>'open' ]) }}">Re-Open</a></li>
							    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $data->id,'status'=>'respond' ]) }}">Respond</a></li>
							    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $data->id,'status'=>'recover' ]) }}">Recover</a></li>
							    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $data->id,'status'=>'resolve' ]) }}">Resolve</a></li>
							    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $data->id,'status'=>'close' ]) }}">Close</a></li>
							    <li class="divider"></li>
							    <li><a href="{{ URL::route('ticket::delete',['id' => $data->id ]) }}">Delete</a></li>
							  </ul>
						</div>
					</div>
				</div>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
			</div>
		</div>
		<div class='row'>
			<div class="col-md-6">
				<h2>{{$data->title}}</h2>
				<p>{{$data->description}}</p>
			</div>
			 <div class="col-md-3">
				 <table class="table table-striped">
			        <thead>
			          <tr>
			              <th>Name</th>
			              <th>Value</th>
			          </tr>
			        </thead>
			        <tbody>
			        	<tr>
			     			<td>Priority</td>
			     			<td>{{$data->priority}}</td>
			     		</tr>
			     		<tr>
			     			<td>Mitra</td>
			     			<td>{{$data->mitra->name}}</td>
			     		</tr>
			     		<tr>
			     			<td>SLA</td>
			     			<td>{{$data->sla->name}}</td>
			     		</tr>
			     		<tr>
			     			<td>Severity</td>
			     			<td>{{$data->severity}}</td>
			     		</tr>
			     		<tr>
			     			<td>Tenant</td>
			     			<td>{{$data->sla->tenant->name}}</td>
			     		</tr>
			     		<tr>
			     			<td>Category</td>
			     			<td>{{$data->category->name}}</td>
			     		</tr>
			     		<tr>
			     			<td>Assign To</td>
			     			<td>
			     				@if($data->assign_type == 'team')
									Team: <a href="{{URL::route('team::view',['id'=>$data->assign_id])}}">{{ $data->assign->name }}</a>
								@else
									User: {{ $data->assign->name }}
								@endif
							</td>
			     		</tr>
			        </tbody>
			      </table>
			</div>
			<div class="col-md-3">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
									     			<td>Due Date</td>
									     			<td>{{$data->due_date}}</td>
									     		</tr> -->
						<tr>
			     			<td>Create</td>
			     			<td>{{$data->created_at}}</td>
			     		</tr>
			     		<tr>
			     			<td>Update</td>
			     			<td>{{$data->updated_at}}</td>
			     		</tr>
			     		<tr>
			     			<td>Respond</td>
			     			<td>{{$data->respond_at}}</td>
			     		</tr>
			     		<tr>
			     			<td>Recover</td>
			     			<td>{{$data->recover_at}}</td>
			     		</tr>
			     		<tr>
			     			<td>Resolve</td>
			     			<td>{{$data->resolve_at}}</td>
			     		</tr>
			     		<tr>
			     			<td>Close</td>
			     			<td>{{$data->close_at}}</td>
			     		</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>Type</th>
							<th>Name</th>
							<th>Min Time</th>
							<th>Proces Time</th>
							<th>Penalty Time</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data->sla->rules as $rules)
							@if($rules->name == $data->severity)
							<tr>
								<td>{{$rules->type}}</td>
								<td>{{$rules->name}}</td>
								<td>{{$rules->min_time->format('H:i:s')}}</td>
								<td>
									@if(isset($data->respond_at) && $rules->type == 'respond')
											{{gmdate('H:i:s',$data->respond_at->diffInSeconds($data->created_at))}}

											( {{$data->respond_at->diffForHumans($data->created_at)}} )
									@elseif(isset($data->recover_at) && $rules->type == 'recover')
											{{gmdate('H:i:s',$data->recover_at->diffInSeconds($data->respond_at))}}

											( {{$data->recover_at->diffForHumans($data->respond_at)}} )
									@elseif(isset($data->resolve_at) && $rules->type == 'resolve')
											{{gmdate('H:i:s',$data->resolve_at->diffInSeconds($data->recover_at))}}

											( {{$data->resolve_at->diffForHumans($data->recover_at)}} )
									@endif
								</td>
								<td>
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
								</td>
							</tr>
							@endif
							

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 pull-right">
			</div>
		</div>
	</div>
</div>
@endsection