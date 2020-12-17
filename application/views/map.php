<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<link data-require="leaflet@0.7.7" data-semver="0.7.7" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <script data-require="leaflet@0.7.7" data-semver="0.7.7" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.0.3/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.0.3/leaflet-routing-machine.css" />
<div class="row">
   <div class="col-md-8">
        <div class="card">
            <div class="mapcanvas" id="map2" style="height: 650px">
                <div id="popup"></div>
            </div>   
        </div>
    </div>
    <div class="col-md-4 shadow" style="padding:5px; border-radius:5px;">

        <div class="card mb-2" style="margin-top:10px;">
            <h5 class="card-header">Informasi</h5>
            <div class="card-body">
              <div class="video">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe width="932" height="524" src="https://www.youtube.com/embed/rS3kGvTZl3I" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
              <div class="video2">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe width="932" height="524" src="https://www.youtube.com/embed/a0Fx528FRQY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
              <div class="images"></div>
            </div>
        </div>
         <div class="card md-2">
            <h4 class="card-header">Gallery</h4>            
            <div class="card-body">
              <?php $this->load->view('images')?>
                <!-- <span id="coordinate"></span> -->
            </div>
        </div>
    </div>
   
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.leaflet-control').hide();
        $('.video').hide();
        $('.video2').hide();
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
            createMarker: function(i, wp) {
                return L.marker(wp.latLng).on('click', function(e) { 
                  open_video1();
                 }).bindPopup('Nama Jalan : JL. KH Wahid Hasyim, 26, Jambi <br /> Nomor : <br /> PIC :<br /> keterangan :');
            },
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
            createMarker: function(i, wp) {
                return L.marker(wp.latLng).on('click', function(e) { 
                  open_video2();
                 }).bindPopup('Nama Jalan : Orang Kayo Hitam Kec. Ps. Jambi <br /> Nomor : <br /> PIC :<br /> keterangan :');
            },
             waypoints: [
              L.latLng(-1.5910250526576806, 103.61329557823376),
              L.latLng(-1.589755669733535, 103.61414215961264)
            ]
          }).addTo(mymap);


           var route3 = L.Routing.control({
            createMarker: function(i, wp) {
                return L.marker(wp.latLng).on('click', function(e) { 
                  open_video1();
                 }).bindPopup('Nama Jalan : Jl. Sultan Thaha, Beringin, Kec. Ps. Jambi, Kota Jambi, Jambi 36123 <br /> Nomor : <br /> PIC : Julian  <br /> keterangan :');
            },
            waypoints: [
              L.latLng(-1.5912915363003146, 103.6138598267069),
              L.latLng(-1.5920577243101925, 103.61424391731649)
            ]
          }).addTo(mymap);

            var route4 = L.Routing.control({
            createMarker: function(i, wp) {
                return L.marker(wp.latLng).on('click', function(e) { 
                  open_video2();
                 }).bindPopup('Nama Jalan : Kantor Cabang Penerbit Erlangga - MUARA BUNGO Jl. H. Somad, Candika, Ora <br /> Nomor : 41<br /> PIC : Julian<br /> keterangan :');
            },
            waypoints: [
              L.latLng(-1.5907116173214686, 103.61423521543114),
              L.latLng(-1.5910160680912355, 103.61445493959867)
            ]
          }).addTo(mymap);
           

function open_video1(){
  $('.video').show();
  $('.video2').hide();
}

function open_video2(){
  $('.video').hide();
  $('.video2').show();
}
    </script>