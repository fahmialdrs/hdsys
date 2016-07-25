@extends('main')
<?php $title = 'Create SLA Rules';?>
@section('title',$title)
@section('content')
  

<div id="page-wrapper">
<!-- 	<div class="container-fluid"> -->
	    <div class="col-md-12">
	        <h1 class="page-header">{{$title}}</h1>
	    </div>
        <!-- /.col-lg-12 -->
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-5">
					<div class="height10"></div>
					<div class="form-group col-lg-12">
			          	<label>Name</label>
						<input value="{{ $data->name or '' }}" class="form-control" type='text' placeholder='SLA Name' disabled/>
			        </div>
			        <div class="height10"></div>
			        <div class="form-group col-md-12">
			        	<label>Description</label>
			        	<textarea class="form-control" placeholder='SLA Description'  disabled>{{ $data->description or '' }}</textarea>
			        </div>
			        <div class="height10"></div>
			        <div class="form-group col-md-12">
						<label>Tenant</label>
						<select id='tenant' class="form-control" disabled>
								<option value="{{$data->tenant->id}}" selected="">{{$data->tenant->name}}</option>
						</select>
					</div>
					<div class="height10"></div>
			        <div class="form-group col-md-12">
						<input ng-click="sla.saveSLA()" type='submit' value="{{ isset($data->id)? 'Update' : 'Create' }}" class='btn btn-primary'>			
					</div>
				</div>
			</div>
			<div class="row">
		        <div class="col-lg-12">
			        <table class="table table-stripe">
			        	<thead>
			        		<tr>
			        			<td>Type</td>
			        			<td>Name</td>
			        			<td>Minimum Time</td>
			        			<td></td>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		@foreach($data->rules as $rules)
			        			<tr>
				        			<td><input class="form-control" type='text' value="{{$rules->type}}" readonly/></td>
				        			<td><input class="form-control" type='text' value="{{$rules->name}}" readonly/></td>
				        			<td><input class="form-control" type='text' value="{{$rules->min_time->format('H:i:s')}}" readonly/></td>
				        			<td><a href="{{ URL::route('sla::deleteRules',['id'=>$rules->id]) }}"><i class="fa fa-close"></a></td>
			        			</tr>
			        		@endforeach
							<form role="form"  method="POST" action="{{ URL::route('sla::storeRules') }}">
								{!! csrf_field() !!}

								 @include('sla._rules')

							</form>
			        	</tbody>
			        </table>
		        </div>
			</div>
		</div>
</div>

 
	
@endsection