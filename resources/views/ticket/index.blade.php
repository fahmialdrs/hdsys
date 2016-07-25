@extends('main')
<?php $title = 'View All Ticket';?>
@section('title',$title)
@section('content')
<script type="text/javascript" src="/asset/js/jquery.countdown.min.js"></script>
<div id="page-wrapper">
    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">{{$title}}</h1>
				<div class="rightButton pull-right">
					<div class='btn-group' role="group">
						<a class="btn btn-primary" href='{{ URL::route("ticket::add") }}'>
							Create New Ticket
						</a>
						<a class="btn btn-default" href='{{ URL::route("ticket::export") }}'>
							Export to xls
						</a>
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
			<div class="col-md-12 form-inline">
				<form action="{{ URL::route('ticket::search') }}" role='form' method="GET" class="pull-right">
					<div class="input-group">
				      <input type="text" name="search" class="form-control" placeholder="Search for...">
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="submit">Go!</button>
				      </span>
				    </div><!-- /input-group -->
			    </form>
			    <div class="input-group pull-right">
				    <a class="btn btn-warning" href="{{URL::route('ticket::index')}}">Clear Search</a>
				</div>
			</div>
			 <div class="col-md-12">
				 <table class="table table-striped">
			        <thead>
			          <tr>
			          		<th>Ticket Id</th>
			              <th>T Sum</th>
			              <th>Category</th>
			              <th>Site Name</th>
			              <th>Site State</th>
			              <th>Mitra</th>
			              <th>Tenant</th>
			              <th>Status</th>
			             <!--  <th>Penalty</th> -->
			              <th>SLA Counter</th>
			              <th>Issuer Email</th>
			              <th>Issuer Name</th>
                    <th>PIC Status</th>
			              <th></th>
			          </tr>
			        </thead>
					<?php //var_dump($data); ?>
			        <tbody>
			        	@foreach($data as $ticket)
			        		<tr>
			        		<?php
			        			$ticketId = preg_replace('/[^a-zA-Z0-9\s]/', '',  $ticket->created_at.$ticket->id);
			        		?>
			        			<td>{{$ticketId}}</td>
			        			<td>{{$ticket->title}}</td>
			        			<td>{{$ticket->category->name}}</td>
			        			<td>{{$ticket->tower->name}}</td>
			        			<td>{{$ticket->tower->state}}</td>
			        			<td>{{$ticket->mitra->name}}</td>
			        			<td>{{$ticket->sla->tenant->name}}</td>
			        			<td>{{$ticket->status}}</td>
			        			<!-- <td>
			        			@foreach($ticket->sla->rules as $rules)
			        												@if($rules->name == $ticket->severity)
			        								        			@if($ticket->status == $rules->type)
			        														<?php
			        															$hour = $rules->min_time->hour * 3600;
			        															$minute = $rules->min_time->minute * 60;
			        															$second = $hour + $minute + $rules->min_time->second;
			        														?>
			        														@if($rules->type == 'respond')
			        															<?php
			        																$process = $ticket->respond_at->diffInSeconds($ticket->created_at);
			        																$penalty = $second - $process;
			        															?>
			        															@if($process > $second)
			        																-
			        															@endif

			        															{{gmdate('H:i:s',abs($penalty))}}
			        														@elseif($rules->type == 'recover')
			        															<?php
			        																$process = $ticket->recover_at->diffInSeconds($ticket->respond_at);
			        																$penalty = $second - $process;
			        															?>
			        															@if($process > $second)
			        																-
			        															@endif

			        															{{gmdate('H:i:s',abs($penalty))}}
			        														@else
			        															<?php
			        																$process = $ticket->resolve_at->diffInSeconds($ticket->recover_at);
			        																$penalty = $second - $process;
			        															?>
			        															@if($process > $second)
			        																-
			        															@endif

			        															{{gmdate('H:i:s',abs($penalty))}}

			        														@endif
			        													@endif
			        												@endif
			        											@endforeach
			        											</td> -->
								<td
								@foreach($ticket->sla->rules as $rules)
									@if($ticket->status == 'open')
										@if($rules->type == 'respond' && $rules->name == $ticket->severity)
										data-countdown="{{ $ticket->created_at->addHours($rules->min_time->hour)
										->addMinutes($rules->min_time->minute)
										->addSeconds($rules->min_time->second)
										}}"
										@endif
									@elseif($ticket->status == 'respond')
										@if($rules->type == 'recover' && $rules->name == $ticket->severity)
										data-countdown="{{ $ticket->respond_at->addHours($rules->min_time->hour)
										->addMinutes($rules->min_time->minute)
										->addSeconds($rules->min_time->second)
										}}"
										@endif
									@elseif($ticket->status == 'recover')
										@if($rules->type == 'resolve' && $rules->name == $ticket->severity)
										data-countdown="{{ $ticket->recover_at->addHours($rules->min_time->hour)
										->addMinutes($rules->min_time->minute)
										->addSeconds($rules->min_time->second)
										}}"
										@endif
									@endif

								@endforeach
								></td>
			        			<td>{{$ticket->email}}</td>
			        			<td>{{$ticket->full_name}}</td>
                    <td>{{$ticket->pic_status}}</td>
			        			<td>
						            <div class="dropdown">
									  <a class='btn-info dropdown-toggle btn' href='#' type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</a>
										  <!-- Dropdown Structure -->
										  <ul class="dropdown-menu dropdown-menu-right">
										    <li><a href="{{ URL::route('ticket::edit',['id' => $ticket->id ]) }}">Edit</a></li>
										    <li><a href="{{ URL::route('ticket::view',['id' => $ticket->id ]) }}">View Details</a></li>
										    <li><a href="{{ URL::route('ticket::generate',['id' => $ticket->id ]) }}">View Permit Letter</a></li>
										    <li class="divider"></li>
										    <li class="dropdown-header">Change Status To</li>
										    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $ticket->id,'status'=>'open' ]) }}">Re-Open</a></li>
										    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $ticket->id,'status'=>'respond' ]) }}">Respond</a></li>
										    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $ticket->id,'status'=>'recover' ]) }}">Recover</a></li>
										    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $ticket->id,'status'=>'resolve' ]) }}">Resolve</a></li>
										    <li><a href="{{ URL::route('ticket::changeStatus',['id' => $ticket->id,'status'=>'close' ]) }}">Close</a></li>
										    <li class="divider"></li>
										    <li><a href="{{ URL::route('ticket::delete',['id' => $ticket->id ]) }}">Delete</a></li>
										  </ul>
									</div>
					            </td>
			        		</tr>
			        	@endforeach
			        </tbody>
			      </table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 pull-right">
				 {!! $data->render() !!}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('[data-countdown]').each(function() {
	   var $this = $(this), finalDate = $(this).data('countdown');
	   $this.countdown(finalDate, {elapse: true})
	   .on('update.countdown', function(event) {
		    var $this = $(this);
		    if (event.elapsed) {
		      $this.html(event.strftime('Penalty: <span style="color:red">%H:%M:%S</span>'));
		    } else {
		      $this.html(event.strftime('Remaining Time: <span>%H:%M:%S</span>'));
		    }
	    });
	});
</script>

@endsection
