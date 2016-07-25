<div class="sidebar-nav navbar-collapse">
	<div class="brand">
		<img src="/asset/img/image00.png" class="img-responsive" alt="">
	</div>
	<ul class="nav" id="side-menu">
		<li>
			<a href="{{ route('dashboard') }}"><i class="fa fa-home fa-fw"></i> Dashboard</a>
		</li>
		<li>
			<a href="#"><i class="fa fa-clock-o fa-fw"></i> SLA</a>
			<ul class="nav nav-second-level">
				<li><a href="{{ URL::route('sla::add') }}">New SLA</a></li>
				<li><a href="{{ URL::route('sla::index') }}">View All SLA</a></li>
			</ul>
		</li>
		<li class="{{ Request::is('mitra*') ? 'active' : '' }}">
			<a href="{{URL::Route('mitra::add')}}"><i class="fa fa-external-link fa-fw"></i> Mitra</a>
		</li>
		<li class="{{ Request::is('category*') ? 'active' : '' }}">
			<a href="{{URL::Route('category::add')}}"><i class="fa fa-external-link fa-fw"></i> Category</a>
		</li>
		<li class="{{ Request::is('tenant*') ? 'active' : '' }}">
			<a href="{{URL::Route('tenant::add')}}"><i class="fa fa-wifi fa-fw"></i> Tenant</a>
		</li>
		<li class="{{ Request::is('team*') ? 'active' : '' }}">
			<a href="#"><i class="fa fa-users fa-fw"></i> Teams</a>
			<ul class="nav nav-second-level">
				<li><a href="{{URL::route('team::add')}}">New Team</a></li>
				<li><a href="{{URL::route('team::index')}}">View All Teams</a></li>
			</ul>
		</li>
		<li class="{{ Request::is('ticket*') ? 'active' : '' }}">
			<a href="#"><i class="fa fa-ticket fa-fw"></i> Tickets</a>
			<ul class="nav nav-second-level">
				<li><a href="{{URL::route('ticket::add')}}">New Ticket</a></li>
				<li><a href="{{URL::route('ticket::indexStatus',['status'=>'open'])}}">Ticket Open</a></li>
				<li><a href="{{URL::route('ticket::indexStatus',['status'=>'respond'])}}">Ticket Respond</a></li>
				<li><a href="{{URL::route('ticket::indexStatus',['status'=>'recover'])}}">Ticket Recover</a></li>
				<li><a href="{{URL::route('ticket::indexStatus',['status'=>'resolve'])}}">Ticket Resolve</a></li>
				<li><a href="{{URL::route('ticket::indexStatus',['status'=>'close'])}}">Ticket Close</a></li>
				<li><a href="{{URL::route('ticket::index')}}">View All Ticket</a></li>
			</ul>
		</li>
		<li {{ (Request::is('*towers') ? 'class="active"' : '') }}>
			<a href="{{URL::Route('towers::index')}}"><i class="glyphicon glyphicon-tower fa-fw"></i> Site</a>
		</li>
		<li class="{{ Request::is('user*') ? 'active' : '' }}">
			<a href="{{URL::Route('user::add')}}"><i class="fa fa-user fa-fw"></i> Users</a>
		</li>
		<li class="{{ Request::is('setting*') ? 'active' : '' }}">
			<a href="#"><i class="fa fa-wrench fa-fw"></i> Settings</a>
			<ul class="nav nav-second-level">
					<li><a href="{{ URL::route('logs') }}">Logs</a></li>
					 <li><a href="{{ URL::route('setting::backup') }}">Backup & Restore</a></li>
					<li>
						<a href="{{ URL::route('user::editPassword',['id' => Auth::user()->id]) }}">Change Password</a>
					</li>
			</ul>
		</li>
		<!-- <li>
			<a href="{{ url ('documentation') }}"><i class="fa fa-file-word-o fa-fw"></i> Documentation</a>
		</li> -->
	</ul>
</div>
<!-- /.sidebar-collapse -->
