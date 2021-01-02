<!DOCTYPE html>
<html>
<head>
    <title>Simple Leaflet Map</title>
    <meta charset="utf-8" />
    <link 
        rel="stylesheet" 
        href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"
    />
</head>
<body>
    <div class="row">
   <div class="col-md-8">
        <div class="card">
            <div class="mapcanvas" id="map3" style="height: 650px">
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
<!-- Button trigger modal -->
<!-- <button class="btn btn-primary" type="button" data-toggle="modal" onclick="open_modal()">Launch Demo Modal</button> -->

<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>

    <script
        src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js">
    </script>

    <script>
    $(document).ready(function() {
        $('.leaflet-control').hide();
        $('.video').hide();
        // $('.video2').hide();
    })

   function open_dialog(id){
    	window.location.href="<?php echo base_url()?>home/show_detail/"+id;
    }
        /*var map = L.map('map3').setView([-1.5901393059041389, 103.613788273547], 17);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; ' + mapLink,
            maxZoom: 22,
            }).addTo(map);*/
    var endPointLocation = new L.LatLng(-1.5901393059041389, 103.613788273547);
    var map = new L.Map("map3", {
      center: endPointLocation,
      zoom: 16,
      layers: new L.TileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png")
    });

    <?php foreach ($row as $key => $value) { ?>
    var a<?php echo $key?> = new L.LatLng(<?php echo $value->waypoint1?>);
    var b<?php echo $key?> = new L.LatLng(<?php echo $value->waypoint2?>);
    
    var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_lokasi?><br /> alamat : <?php echo $value->alamat?><br /><br /> Keterangan : <?php echo $value->keterangan?><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit</a>').addTo(map);
    var marker_b<?php echo $key?> = new L.Marker(b<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_lokasi?><br /> alamat : <?php echo $value->alamat?><br /><br /> Keterangan : <?php echo $value->keterangan?><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit</a>').addTo(map);

    <?php }?>    

    var data = [
    <?php foreach ($row as $key => $value) { ?>
	  [
	  	[<?php echo $value->waypoint1?>],[<?php echo $value->waypoint2?>]
	  ],
	<?php }?>
	  /*[
	  	[0, -60],[0, 60]
	  ]*/
	];


    /* var polyline = L.polyline([
     	<?php foreach ($row as $key => $value) { ?>
     		[[<?php echo $value->waypoint1?>, <?php echo $value->waypoint2?>]],
     	<?php } ?>
     	]).addTo(map);*/
     	data.forEach(function (points) {

			  var polyline = L.polyline(
			    points, {
			      weight: 6,
			      clickable: true
			    }
			  ).addTo(map);
			  
			  polyline.on('click', function (e) {
			    if (group.getLayers().length === 0) {
			      e.target._latlngs.forEach(function (latlng) {
			        group.addLayer(L.marker(latlng));
			      });
			    } else {
			      group.clearLayers();
			    }
			  });

			});
    </script>
</body>
</html>