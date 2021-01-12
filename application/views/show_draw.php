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
            <h5 class="card-header">Video</h5>
            <div class="card-body">
              <div class="video">
                <div class="embed-responsive embed-responsive-16by9">
                  <!-- <iframe width="932" height="524" src="https://www.youtube.com/embed/rS3kGvTZl3I" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
              </div>
             <!--  <div class="video2">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe width="932" height="524" src="https://www.youtube.com/embed/a0Fx528FRQY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div> -->
              <!-- <div class="images"></div> -->
            </div>
        </div>
        <!--  <div class="card md-2">
            <h4 class="card-header">Gallery</h4>            
            <div class="card-body">
              <?php //$this->load->view('images')?>
            </div>
        </div> -->
    </div>
   
</div>
<!-- Button trigger modal -->
<!-- <button class="btn btn-primary" type="button" data-toggle="modal" onclick="open_modal()">Launch Demo Modal</button> -->
<link rel="stylesheet" href="https://tombatossals.github.io/angular-leaflet-directive/bower_components/Leaflet.ExtraMarkers/src/leaflet.extra-markers.css">
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

    function open_dialog_hapus(id){
      if(confirm('Are you sure Delete this data?')) {
        $.ajax({
            url : "<?php echo site_url('home/hapus_data')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                alert(data.message);
                window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                 alert(data.message);
            }
        });
      }
    }

    function show_video(link){
      var link_video = "<?php echo base_url()?>video/"+link;
      $('.video').show();
      $('.embed-responsive').html("");
      $('.embed-responsive').append('<video id="video" width="1180" height="664" poster="put here your poster url" preload="auto" controls="true"><source src="'+link_video+'" type="video/mp4"></video>');
    }

        /*var map = L.map('map3').setView([-1.5901393059041389, 103.613788273547], 17);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; ' + mapLink,
            maxZoom: 22,
            }).addTo(map);*/
    var endPointLocation = new L.LatLng(-1.2094908817570897, 103.79153016954439);
    var map = new L.Map("map3", {
      center: endPointLocation,
      zoom: 16,
      layers: new L.TileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png")
    });

    <?php foreach ($row as $key => $value) { ?>
    // var a<?php echo $key?> = new L.LatLng(-1.20387,103.78999);
    // var b<?php echo $key?> = new L.LatLng(<?php echo $value->waypoint2?>);
    
    /*var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Kecamatan : <?php echo $value->nama_kecamatan?><br /><br /> Jenis Permukaan : <?php echo $value->jenis?><br /> Panjang Ruas : <?php echo $value->panjang_ruas?><br /> Lebar Ruas : <?php echo $value->lebar_ruas?><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit</a>').addTo(map);*/

    /*var marker_b<?php echo $key?> = new L.Marker(b<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Kecamatan : <?php echo $value->nama_kecamatan?><br /> Jenis Permukaan : <?php echo $value->jenis?><br /><br /> Panjang Ruas : <?php echo $value->panjang_ruas?><br /> Lebar Ruas : <?php echo $value->lebar_ruas?><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit</a>').addTo(map);*/


    let string<?php echo $key?> = "<?php echo $value->waypoint2?>",
              splittedArray<?php echo $key?> = string<?php echo $key?>.split("LatLng"),
              outputArray<?php echo $key?> = [];
           
          var no=1;
          splittedArray<?php echo $key?>.forEach(o => {
            if(o){
             
             let extractedLTLNG =  o.match(/\(([^)]+)\)/)[1].split(",");
             var extractedLTLNG2 = extractedLTLNG.map(parseFloat)
             let tempArray = [extractedLTLNG2[0], extractedLTLNG2[1]];
               outputArray<?php echo $key?>.push(tempArray);
                if(no==1){

                  <?php if($value->type_ruas_id==4){?>
                  var LeafIcon = L.Icon.extend({
                    options: {
                      shadowUrl: 'https://www.flaticon.com/svg/vstatic/svg/701/701666.svg?token=exp=1610449539~hmac=609e54a9f201d79f0c0d6b854418b83a',
                      iconSize:     [38, 95],
                      shadowSize:   [0, 0],
                      iconAnchor:   [12, 64],
                      shadowAnchor: [4, 59],
                      popupAnchor:  [-3, -76]
                    }
                  });

                  var greenIcon = new LeafIcon({iconUrl: 'https://www.flaticon.com/svg/vstatic/svg/701/701666.svg?token=exp=1610449539~hmac=609e54a9f201d79f0c0d6b854418b83a'});
                  //awal array
                  var a<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                  var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {icon: greenIcon}, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Kecamatan yang dilalui : <?php echo $value->nama_kecamatan?><br /> Type : <?php echo $value->nama_ruas?><br /><br /> Jenis Permukaan : <?php echo $value->jenis?><br /> Panjang Ruas : <?php echo $value->panjang_ruas?> km<br /> Lebar Ruas : <?php echo $value->lebar_ruas?> m<br /><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit atau Tambah Ruas</a> || <a href="#" onclick="open_dialog_hapus(<?php echo $value->id_lokasi?>)">Hapus</a>').addTo(map);
                <?php }else{?>
                  //awal array
                  var a<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                  var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Type : <?php echo $value->nama_ruas?><br /> Kecamatan yang dilalui : <?php echo $value->nama_kecamatan?><br /><br /> Jenis Permukaan : <?php echo $value->jenis?><br /> Panjang Ruas : <?php echo $value->panjang_ruas?> km<br /> Lebar Ruas : <?php echo $value->lebar_ruas?> m<br /><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit atau Tambah Ruas</a>').addTo(map);
                <?php } ?>

                }
                  //end array
                  <?php if($value->type_ruas_id==3){?>
                  if((no + 1) == (splittedArray<?php echo $key?>.length)){
                      // console.log("Last iteration with item : " + extractedLTLNG2[0]);
                      var b<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                      var marker_b<?php echo $key?> = new L.Marker(b<?php echo $key?>, {draggable: false}).bindPopup('Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Kecamatan yang dilalui : <?php echo $value->nama_kecamatan?><br /> Type : <?php echo $value->nama_ruas?><br /><br /> Jenis Permukaan : <?php echo $value->jenis?><br /> Panjang Ruas : <?php echo $value->panjang_ruas?> km<br /> Lebar Ruas : <?php echo $value->lebar_ruas?> m<br /><br /><a href="#" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit atau Tambah Ruas</a> || <a href="#" onclick="open_dialog_hapus(<?php echo $value->id_lokasi?>)">Hapus</a>').addTo(map).on('click', function(e) {
                            show_video('<?php echo $value->link_video?>');
                        });;
                  }
                <?php } ?>
                // console.log(no);
                no++;
            }else{
             return;
            }
          })
          
          var data<?php echo $key?> = outputArray<?php echo $key?>;
          //console.log(data);
          var latlang = data;
         
          // var polyline = L.polyline(data<?php echo $key?>).addTo(map);
          var polyline = L.polyline(data<?php echo $key?>, {
                    color: '<?php echo $value->kode_warna?>',
                    weight: 5,
                    opacity: 0.5,
                    smoothFactor: 10
             }).addTo(map);

    <?php }?>    
    
    var data = [
    <?php foreach ($row as $key => $value) { ?>
	  [
	  	[<?php //echo $value->waypoint1?>],[<?php //echo $value->waypoint2?>]
	  ],
	<?php }?>
	  /*[
	  	[0, -60],[0, 60]
	  ]*/
	];


    
     	/*data.forEach(function (points) {

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

			});*/
    </script>
</body>
</html>