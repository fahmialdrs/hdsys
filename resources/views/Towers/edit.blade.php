@extends('main')
@section('title','Edit Tower Profile')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYVFA9ZJRsqataBP6FzLEefB-rboCfBaI&libraries=places&callback=initMap&language=id-ID" async defer></script>

    <div id="page-wrapper">
      <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Tower Profile</h1>
            </div>
      </div>

      <div class="row">
          <div class="col-lg-8">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <i class="fa fa-map-marker fa-fw"></i> Maps
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('map', 'Map') !!}
                        {!! Form::text('map', $towers->city, ['class' => 'form-control','id' => 'searchmap', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('map') }}</small>
                    </div>
                    <div id="map" style="width:650px;height:380px;"></div>
                  </div>
              </div>

          </div>
          <div class="col-lg-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <i class="fa fa-info fa-fw"></i> Profile
                  </div>
                  <div class="panel-body">
                    <table class="table table-striped">
                      <tbody>
                        {!! Form::open(['method' => 'PUT', 'route' => array('towers::update', $towers->id), 'class' => 'form-horizontal']) !!}
                          <tr>
                          <div class="form-group">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name', $towers->name, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('sitename', 'Site Name') !!}
                              {!! Form::text('sitename', $towers->site_name, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('sitename') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('description', 'Description') !!}
                              {!! Form::text('description', $towers->description, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('description') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('latitude', 'Latitude') !!}
                              {!! Form::text('latitude', $towers->latitude, ['class' => 'form-control','id' => 'lat', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('latitude') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('longitude', 'Longitude') !!}
                              {!! Form::text('longitude', $towers->longitude, ['class' => 'form-control','id' => 'lng', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('longitude') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('state', 'State') !!}
                              {!! Form::text('state', $towers->state, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('state') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('city', 'City') !!}
                              {!! Form::text('city', $towers->city, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('city') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('address', 'Address') !!}
                              {!! Form::text('address', $towers->address, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('address') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                            <div class="main-actions">
                              <input id="getcitystate" class="btn btn-small btn-primary" type="button" value="Get City & State">
                              {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                            </div>
                          </div>
                        </tr>
                        {!! Form::close() !!}
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
          </div>
</div>
        {{-- <div class="panel-body">
          <div class="col-sm-8">
    {!! Form::open(['method' => 'PUT', 'url' => 'admin/towers' .'/'. $towers->id, 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $towers->name, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}:
            {!! Form::text('description', $towers->description, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('description') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('searchmap', 'Map') !!}
            {!! Form::text('searchmap', $towers->state, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('searchmap') }}</small>
        </div>
        <div id="map" style="width:600px;height:380px;"></div>

        <div class="form-group">
            {!! Form::label('lat', 'Latitude') !!}
            {!! Form::text('lat', $towers->latitude, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('lat') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('lng', 'Longitude') !!}
            {!! Form::text('lng', $towers->longitude, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('lng') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('state', 'State') !!}
            {!! Form::text('state', $towers->state, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('state') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('city', 'City') !!}
            {!! Form::text('city', $towers->city, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('city') }}</small>
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address') !!}
            {!! Form::text('address', $towers->address, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('address') }}</small>
        </div>

        <div class="form-group">
          <div class="main-actions">
                <button class="btn btn-small btn-primary">Save</button>
                <input id="getcitystate" class="btn btn-small btn-primary" type="button" value="Get City & State">
          </div>
        </div>

    {!! Form::close() !!}

  </div>
</div>
</div>
</div> --}}
<script>
  var lat = {{ $towers->latitude }};
  var lng = {{ $towers->longitude}};
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
      lng: lng
    },
    icon: '/asset/img/tower.png',
    map: map,
    draggable: true
    });

  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

   searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;

    for(i=0; place=places[i];i++){
      bounds.extend(place.geometry.location);
      marker.setPosition(place.geometry.location);
    }

    map.fitBounds(bounds);
    map.setZoom(15);


 });

 marker.addListener('position_changed', function(){
   var lat = marker.getPosition().lat();
   var lng = marker.getPosition().lng();
   $('#lat').val(lat);
   $('#lng').val(lng);
 });

 var geocoder = geocoder = new google.maps.Geocoder();
 document.getElementById('getcitystate').addEventListener('click', function() {
   var a = document.getElementById('lat').value;
   var b = document.getElementById('lng').value;
   var latlng = new google.maps.LatLng(a,b);
   geocoder.geocode({ 'latLng': latlng }, function (results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
           if (results[1]) {
           // console.log(document.getElementById('lat').value);
           // console.log(document.getElementById('lng').value);
           var address = null, city = null, state = null;
            var c, lc, component;
            for (var r = 0, rl = results.length; r < rl; r += 1) {
                var result = results[r];

                if (!city && result.types[0] === 'locality') {
                    for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                        component = result.address_components[c];

                        if (component.types[0] === 'locality') {
                            city = component.long_name;
                            break;
                        }
                    }
                }

                if (city && state) {
                    break;
                }
            }

            for (var i = 0; i < results[0].address_components.length; i++) {
                var addr = results[0].address_components[i];
                if (addr.types[0] == 'street_address'){
                    address = address + addr.long_name;
                } else if (addr.types[0] == ['administrative_area_level_1']){
                    state = addr.long_name;
                } else if (addr.types[0] == 'route') {
                    address = addr.long_name;
             }
           }

           document.getElementById('state').value = state;
           document.getElementById('city').value = city;
           document.getElementById('address').value = address;

           } else {
             console.log("Tidak ada hasil dari geocoder");
           }
       }
   });
   });
}
</script>
@endsection
