@extends('main')
@section('title','View Tower')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYVFA9ZJRsqataBP6FzLEefB-rboCfBaI&libraries=places&callback=initMap&language=id-ID" async defer></script>

    <div id="page-wrapper">
      <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tower Detail #{{ $tower->id }}</h1>
            </div>
      </div>
        {{-- <h2>Data {{ $tower->name }}</h2>
        <div class="row">
        <div class="col-lg-11">
          <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Map
                        </div>
                        <div class="panel-body">
                        <div id="map" style="width:600px;height:380px;"></div>
                        <div class="col-lg-6">
                        <div class="panel panel-default">
                          <div class="panel-heading">Tower Information</div>

                          <table class="table">
                            ...
                          </table>
                        </div>
                      </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-map-marker fa-fw"></i> Maps
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="/towers/edit/{{ $tower->id }}">Edit</a>
                            </li>
                            <li class="text-primary"><a href="/towers/delete/{{ $tower->id }}">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div id="map" style="width:650px;height:380px;"></div>
            </div>
            <!-- /.panel-body -->
        </div>

        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-info fa-fw"></i> Information
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>ID</td> <td>{{ $tower->id }}</td>
                  </tr>
                  <tr>
                    <td>Name</td> <td>{{ $tower->name }}</td>
                  </tr>
                  <tr>
                    <td>Site Name</td> <td>{{ $tower->site_name }}</td>
                  </tr>
                  <tr>
                    <td>Description</td> <td>{{ $tower->description }}</td>
                  </tr>
                  <tr>
                    <td>Address</td> <td>{{ $tower->address }}</td>
                  </tr>
                  <tr>
                    <td>City</td> <td>{{ $tower->city }}</td>
                  </tr>
                  <tr>
                    <td>State</td> <td>{{ $tower->state }}</td>
                  </tr>
                  <tr>
                    <td>Longitude</td> <td>{{ $tower->longitude }}</td>
                  </tr>
                  <tr>
                    <td>Latitude</td> <td>{{ $tower->latitude }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>
</div>
    <script>
      var lat = {{ $tower->latitude }};
      var lng = {{ $tower->longitude }};
      var map;
      function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: lat,
          lng: lng
        },
        zoom: 15
      });

      var marker = new google.maps.Marker({
        position: {
          lat: lat,
          lng: lng,
        },
        icon: '/asset/img/tower.png',
        map: map
        });

   }
    </script>
@endsection
