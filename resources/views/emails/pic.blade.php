<h2>Centratama</h2>
<small>Pinang 22 Building, 8th Floor
Jl. Ciputat Raya No. 22A, Pondok Pinang
Jakarta Selatan, 12310</small>

@if($data->assign_type=='team')
<p>Kepada {{ $user->name }}</p>
@else
<p>Kepada {{ $data->assign->name }}</p>
@endif
<p>Sehubung dengan ticket #{{$data->id}} </p>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Ticket ID</td>
			<td>{{$data->id}}</td>
		</tr>
		<tr>
			<td>Ticket Summary</td>
			<td>{{$data->title}}</td>
		</tr>
		<tr>
			<td>Ticket Category</td>
			<td>{{$data->category->name}}</td>
		</tr>
		<tr>
			<td>Ticket Description</td>
			<td>{{$data->description}}</td>
		</tr>
	</tbody>
</table>
<p>maka untuk hal tersebut diatas, menugaskan <strong>{{$data->mitra->name}}</strong> untuk melakukan tugas tersebut</p>
<thead>
	<tr>
		<th>Name</th>
		<th>Value</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>Tower ID</td>
		<td>{{$data->tower->id}}</td>
	</tr>
	<tr>
		<td>Tower Name</td>
		<td>{{$data->tower->name}}</td>
	</tr>
	<tr>
		<td>Tower Address</td>
		<td>{{$data->tower->address}}</td>
	</tr>
	<tr>
		<td>Tower City</td>
		<td>{{$data->tower->city}}</td>
	</tr>
	<tr>
		<td>Tower State</td>
		<td>{{$data->tower->state}}</td>
	</tr>
	<tr>
		<td>Action</td>
		<td>
			<li><a href="{{ URL::route('ticket::picStatusRespond',['id' => $data->id,'pic_status'=>'Respond' ]) }}">Respond</a></li>
			<li><a href="{{ URL::route('ticket::picStatusRecover',['id' => $data->id,'pic_status'=>'Recover' ]) }}">Recover</a></li>
			<li><a href="{{ URL::route('ticket::picStatusResolve',['id' => $data->id,'pic_status'=>'Resolve' ]) }}">Resolve</a></li>
			<li><a href="{{ URL::route('ticket::picStatusClose',['id' => $data->id,'pic_status'=>'Close' ]) }}">Close</a></li>
		</td>
	</tr>
</tbody>
</table>
