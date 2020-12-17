<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<link data-require="leaflet@0.7.7" data-semver="0.7.7" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <script data-require="leaflet@0.7.7" data-semver="0.7.7" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.0.3/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.0.3/leaflet-routing-machine.css" />
<div class="row">
    <div class="col-md-4 shadow" style="padding:5px; border-radius:5px;">
        <div class="card md-2">
            <h4 class="card-header">Koordinat Kursor</h4>            
            <div class="card-body">
                <span id="coordinate"></span>
            </div>
        </div>
        <div class="card mb-2" style="margin-top:10px;">
            <h5 class="card-header">Informasi</h5>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="mapcanvas" id="map2">
                <div id="popup"></div>
            </div>   
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.leaflet-control').hide();
    })
        var mymap = L.map('map2', { zoomControl: false , attributionControl: false}).setView([-1.5901393059041389, 103.613788273547], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

            L.marker([-1.5901393059041389, 103.613788273547]).bindPopup('Pantai Widuri').addTo(mymap);
            L.marker([-1.5908134888912264, 103.6148564626511]).bindPopup('Nilla Collection').addTo(mymap);
        L.marker([-1.5910250526576806, 103.61329557823376]).bindPopup('Alun-Alun Jambi').addTo(mymap);
        L.marker([-1.589755669733535, 103.61414215961264]).bindPopup('Hotel Aston Jambi').addTo(mymap);

          var route1 = L.Routing.control({
           // createMarker: function() { return null; },
            waypoints: [
              L.latLng(-1.5901393059041389, 103.613788273547),
              L.latLng(-1.5908134888912264, 103.6148564626511)
            ]
          }).addTo(mymap);

          var route2 = L.Routing.control({
            /*createMarker: function(waypointIndex, waypoint, numberOfWaypoints) {
                return L.marker(waypoint.latLng)
                    .bindPopup('Hello');
            },*/
            // createMarker: function() { return null; },
             waypoints: [
              L.latLng(-1.5910250526576806, 103.61329557823376),
              L.latLng(-1.589755669733535, 103.61414215961264)
            ]
          }).addTo(mymap);

          var marker = L.marker([-1.5901393059041389, 103.613788273547],{
              draggable: true
            }).addTo(mymap);
                      

marker.on('dragend', function (e) {
  // document.getElementById('latitude').value = marker.getLatLng().lat;
  alert(marker.getLatLng().lng);
});

    </script>