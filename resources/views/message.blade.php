@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
	{!! Session::get("success") !!}

</div>
@endif
@if (Session::has('error'))
<div class="alert alert-error alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
	{!! Session::get("error") !!}
</div>
@endif

@if (count($errors->input) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->input->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif