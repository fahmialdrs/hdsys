<!DOCTYPE html>
<html>
<head>
	<title>Surat Izin #{{$data->id}}</title>
	
	<link rel="stylesheet" href="{{ public_path('/asset/css/bootstrap.min.css') }}" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{{ public_path('/asset/css/style.css') }}" media="screen" title="no title" charset="utf-8">
	<!-- <link rel="stylesheet" href="/asset/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="/asset/css/style.css" media="screen" title="no title" charset="utf-8"> -->
	<style>
	.page-break {
	    page-break-after: always;
	}
	</style>

	<script src="{{ public_path('/asset/js/jquery-2.1.4.min.js') }}" charset="utf-8"></script>
	    <script src="{{ public_path('/asset/js/bootstrap.min.js') }}" charset="utf-8"></script>

    <!-- <script src="/asset/js/jquery-2.1.4.min.js" charset="utf-8"></script>
    <script src="/asset/js/bootstrap.min.js" charset="utf-8"></script> -->
    <title>Permit Letter</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="row headerPermit">
				<div class="col-xs-5">
					<h2>Permit Letter</h2>
					<p>Jalan Margonda Raya No.100, Beji, Jawa Barat</p>
				</div>
				<div class="col-xs-7">
					<img src="{{ public_path('/asset/img/ug.jpg') }}">
				</div>
				<div class="height30"></div>
			</div>
			<div class="col-xs-3 pull-right">
					<div class="height30"></div>
					<span>Jakarta, {{$data->created_at->toFormattedDateString()}}</span>
			</div>
			
			<div class="col-xs-8 pull-left">
				<div class="height30"></div>
				<p>Dengan Hormat,</p>
				<div class="height10"></div>
				<p>Sehubungan dengan laporan Trouble Ticket:</p>
			</div>
			<table class="table">
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
			<p>oleh <strong>{{$data->sla->tenant->name}}</strong> maka untuk hal tersebut diatas, menugaskan <strong>{{$data->mitra->name}}</strong> untuk melakukan tugas tersebut, mohon kiranya diberikan akses</p>
			<div class="row">
				<div class="col-xs-12">
				<table class="table">
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
					</tbody>
				</table>
			</div>
			<div class="col-xs-12">
				<table class="table">
					<thead>
						<tr>
							<th>PIC</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						@if($data->assign_type=='team')
							@foreach($data->assign->user as $team)
								<tr>
									<td>{{$team->name}}</td>
									<td>{{$team->name}}</td>
									<td>{{$team->email}}</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="col-xs-12">
				<p>Nama PIC yang bekerja harus tercantum di atas.</p>
				<p>Demikian surat ini disampaikan, atas perhatian dan kerjasama kami ucapkan terima kasih</p>
				<div class="height10"></div>
				<p>Hormat Kami,</p>
				<p>
					<strong>PT. Tower Provider</strong>
				</p>
			</div>
			</div>
		</div>
	</div>
</body>
</html>
