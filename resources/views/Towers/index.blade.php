@extends('main')
@section('title','Towers')


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Towers Profile</h1>
            </div>
            <div class="panel-body">
                                        {{-- <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Towers</th>
                                                        <th>Description</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Address</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($data as $data)
                                                  <tr>
                                                    <td>
                                                      {{ $data->id }}
                                                    </td>
                                                    <td>
                                                      {{ $data->name }}
                                                    </td>
                                                    <td>
                                                      {{ $data->description }}
                                                    </td>
                                                    <td>
                                                      {{ $data->state }}
                                                    </td>
                                                    <td>
                                                      {{ $data->city }}
                                                    </td>
                                                    <td>
                                                      {{ $data->address }}
                                                    </td>
                                                    <td>
                                                      <div class="dropdown">
                                                       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                       <span class="caret"></span></button>
                                                       <ul class="dropdown-menu pull-right">
                                                         <li><a href="{{ url('admin/towers') . '/' . $data->id }}">View</a></li>
                                                         <li><a href="{{ url('admin/towers'). '/' . $data->id . '/edit'}}">Edit</a></li>
                                                         <li><a href="" class="load-confirmation-modal" data-url="{{url('admin/towers'). '/' . $data->id }}" data-toggle ="modal" data-target='#confirmation-modal'>Delete</a></li>
                                                       </ul>
                                                      </div>
                                                  </td>
                                                  </tr>
                                                  @endforeach
                                                </tbody>
                                            </table>
                                        </div> --}}
                            <div class="dataTable_wrapper">
                              <table class="table table-striped table-bordered table-hover" id="towerlist">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Tower Name</th>
                                          <th>Site</th>
                                          <th>Description</th>
                                          <th>State</th>
                                          <th>City</th>
                                          <th>Address</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  {{-- <tbody>
                                    @foreach($data as $data)
                                    <tr>
                                      <td>
                                        {{ $data->id }}
                                      </td>
                                      <td>
                                        {{ $data->name }}
                                      </td>
                                      <td>
                                        {{ $data->description }}
                                      </td>
                                      <td>
                                        {{ $data->state }}
                                      </td>
                                      <td>
                                        {{ $data->city }}
                                      </td>
                                      <td>
                                        {{ $data->address }}
                                      </td>
                                      <td>
                                        <div class="dropdown">
                                         <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                         <span class="caret"></span></button>
                                         <ul class="dropdown-menu pull-right">
                                           <li><a href="{{ url('admin/towers') . '/' . $data->id }}">View</a></li>
                                           <li><a href="{{ url('admin/towers'). '/' . $data->id . '/edit'}}">Edit</a></li>
                                           <li><a href="" class="load-confirmation-modal" data-url="{{url('admin/towers'). '/' . $data->id }}" data-toggle ="modal" data-target='#confirmation-modal'>Delete</a></li>
                                         </ul>
                                        </div>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody> --}}
                                </table>
                                <div class="main-actions">
                                  <a class="btn btn-small btn-primary" href="{{ url('towers/create') }}">Add Tower</a>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

      <script src="/asset/css/datatables/media/js/jquery.dataTables.min.js" charset="utf-8"></script>
      <script src="/asset/css/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js" charset="utf-8"></script>
@endsection
@push('script')
<script>
$(function() {
    $('#towerlist').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatablestower.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'site_name', name: 'site_name' },
            { data: 'description', name: 'description' },
            { data: 'state', name: 'state' },
            { data: 'city', name: 'city' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action',  orderable: false, searchable: false}

          ]
    });
});
</script>
@endpush


