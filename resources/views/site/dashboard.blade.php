@extends('main')

@section('title','Dashboard')

@section('content')

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
		
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
$(function() {

  // Create a function that will handle AJAX requests
  function requestData(chart){
    $.ajax({
      type: "GET",
      dataType: 'json',
      url: "{{URL::route('statistic::ticketByMonth')}}", // This is the URL to the API
      //data: { days: days }
    })
    .done(function( data ) {
      // When the response to the AJAX request comes back render the chart with new data
      chart.setData(data);
    })
    .fail(function() {
      // If there is no communication between the server, show an error
      alert( "error occured" );
    });
  }

  var chart = Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'ticket_div',
    data: [0, 0], // Set initial data (ideally you would provide an array of default data)
    xkey: 'date', // Set the key for X-axis
    ykeys: ['views'], // Set the key for Y-axis
    labels: ['Ticket By Month'] // Set the label when bar is rolled over
  });

  // Request initial data for the past 7 days:
  requestData(chart);
});
</script>
	    <div class="col-md-12">
	    	<div class="page-header clearfix">
				<h1 class="pull-left">Dashboard</h1>
	    	</div>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<h1>Welcome, <strong>{{ Auth::user()->name}}</strong></h1>
			<div class="row">
				<div class="col-md-12">
					<div id="ticket_div"></div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
            <div class="panel-heading">
                20 Most Trouble Tower
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
               			<th>no</th>
               			<th>Tower Name</th>
               			<th>TT</th>
               		</tr>
                </thead>
                <tbody>
                 	<?php $i=1; ?>
             			@foreach($mostTroubleTower as $most)
                    <tr>
                      <td>{{$i++}}</td>
    									<td><a href="#">{{$most->tower->name}}</a></td>
    									<td>{{ $most->count}}</td>
    								</tr>
								  @endforeach
                </tbody>
              </table>
            </div>
          </div>					
				</div>
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
                Ticket Open
            </div>
            <div class="panel-body">
              <h2>{{$open->count()}}</h2>
            </div>
          </div>          
        </div>
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
                Ticket Respond
            </div>
            <div class="panel-body">
              <h2>{{$respond->count()}}</h2>
            </div>
          </div>          
        </div>
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
                Ticket Resolve
            </div>
            <div class="panel-body">
              <h2>{{$resolve->count()}}</h2>
            </div>
          </div>          
        </div>
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
                Ticket Recover
            </div>
            <div class="panel-body">
              <h2>{{$recover->count()}}</h2>
            </div>
          </div>          
        </div>
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
                Ticket Close
            </div>
            <div class="panel-body">
              <h2>{{$close->count()}}</h2>
            </div>
          </div>          
        </div>
			</div>
		</div>
</div>
@endsection