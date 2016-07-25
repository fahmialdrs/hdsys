@extends('main')
@section('title','Create Tower Profile')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYVFA9ZJRsqataBP6FzLEefB-rboCfBaI&libraries=places&callback=initMap&language=id-ID" async defer></script>

    <div id="page-wrapper">
      <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Tower Profile</h1>
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
                        {!! Form::text('map', null, ['class' => 'form-control','id' => 'searchmap', 'required' => 'required']) !!}
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
                        {!! Form::open(['method' => 'POST', 'route' => 'towers::store', 'class' => 'form-horizontal']) !!}
                        <tr>
                          <div class="form-group">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('sitename', 'Site Name') !!}
                              {!! Form::text('sitename', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('sitename') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('description', 'Description') !!}
                              {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('description') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('latitude', 'Latitude') !!}
                              {!! Form::text('latitude', null, ['class' => 'form-control','id' => 'lat', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('latitude') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('longitude', 'Longitude') !!}
                              {!! Form::text('longitude', null, ['class' => 'form-control','id' => 'lng', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('longitude') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('state', 'State') !!}
                              {!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('state') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('city', 'City') !!}
                              {!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('city') }}</small>
                          </div>
                        </tr>
                        <tr>
                          <div class="form-group">
                              {!! Form::label('address', 'Address') !!}
                              {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
<script>
var map;
var placeSearch, autocomplete;
function initMap() {
 var geocoder = new google.maps.Geocoder;
 var pyrmont = {lat: -6.4024844, lng: 106.7942405};

 map = new google.maps.Map(document.getElementById('map'), {
   center: pyrmont,
   zoom: 15
 });

 var marker = new google.maps.Marker({
   position: {
     lat: -6.4024844,
     lng: 106.7942405
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

})

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
