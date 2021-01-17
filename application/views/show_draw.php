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
<style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Lato:300,900);
p.remarks, a{
  text-align: center;
  color: #FFFFFF;
}

.container2{
  width: 100%;
  max-width: 700px;
  min-width: 300px;
  margin: 0 auto;
  padding: -1px 5vh;
}

/* accordion-1 */
#accordion-1{
  position: relative;
  box-shadow: 0px 1px 7px #DBDBDB;
}

#accordion-1 .head{
  background-color: #FFFFFF;
  color: #563e6e;
  padding: 20px 30px;
  cursor: pointer;
  transition: 0.2s ease;
}

#accordion-1 .arrow{
  position: absolute;
  color: #563e6e;
  right: 30px;
  top: 15px;
  font-size: 40px;
  transition: 0.25s ease;
  opacity: 0.3;
  transform: rotate(-90deg);
}

#accordion-1 .head:hover .arrow{
  opacity: 1;
}

#accordion-1 .head:hover, #accordion-1 .active{
  background-color: #FFE77AFF;
}

#accordion-1 .arrow-animate{
  transform: rotate(0deg);
  opacity: 1;
}

#accordion-1 .content{
  background-color: #FFFFFF;
  display: none;
  padding: 20px 30px;
  color: #333333;
}
</style>
<body>
    <div class="row">
   <div class="col-md-8">
        <div class="card">
            <div class="mapcanvas" id="map3" style="height: 650px">
                <div id="popup"></div>
            </div>   
        </div>
    </div>
    <div class="col-md-4" style="padding:5px; border-radius:5px;">
        <div class="container2">
          <div id="accordion-1">
            <div class="head">
              <h4>Filter Map</h4>
              <i class="fas fa-angle-down arrow"></i>
            </div>
            <div class="content">
              <form class="form-horizontal" method="POST" action="<?php echo base_url()?>home/index">
              <table class="table">
                <tr>
                  <td>Kecamatan</td>
                  <td>
                       <select name="kecamatan" class="form-control">
                        <option value="">-Tampilkan Semua-</option>
                           <?php foreach($master_kecamatan as $kecamatan):
                            if($kecamatan->id==$kecamatan_id){
                              $sel = "selected";
                            }else{
                              $sel="";
                            }
                            ?>
                            <option <?php echo $sel?> value="<?php echo $kecamatan->id?>"><?php echo $kecamatan->nama?></option>
                           <?php endforeach;?>
                         </select>
                  </td>
                </tr>
                <tr>
                  <td>Type Ruas</td>
                  <td>
                    <select name="type_ruas" id="type_ruas" class="form-control">
                      <option value="">-Tampilkan Semua-</option>
                       <?php foreach($master_type as $t):
                            if($t->id==$type_ruas_id){
                              $sel = "selected";
                            }else{
                              $sel="";
                            }
                        ?>
                        <option <?php echo $sel?> value="<?php echo $t->id?>"><?php echo $t->nama?></option>
                       <?php endforeach;?>
                     </select>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Permukaan</td>
                  <td>
                    <select name="type" class="form-control">
                      <option value="">-Tampilkan Semua-</option>
                       <?php foreach($master_jenis as $type):
                        if($type->id==$jenis){
                              $sel = "selected";
                            }else{
                              $sel="";
                            }
                        ?>
                        <option <?php echo $sel?> value="<?php echo $type->id?>"><?php echo $type->jenis?></option>
                       <?php endforeach;?>
                     </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right"><button type="submit" class="btn btn-sm btn-success"><i class="fas fa-search"></i> Cari</button></td>
                </tr>
              </table>
              </form>
            </div>
          </div>
        </div>
        <?php if($posting==true):?>
       
            <div class="card mb-2" style="margin-top:10px;">
              <div class="card-header">
                <h4>Hasil Pencarian</h4>
              </div>
                <div class="card-body">
                <?php 
                  foreach ($row as $key => $value) { 
                    $nama_kecamatan = (!empty($kecamatan_id))?$value->nama_kecamatan:'';
                    $nama_ruas = (!empty($type_ruas_id))?$value->nama_ruas:'';
                    $jenis =  (!empty($jenis))?$value->jenis:'';
                  }
                ?>
                <div class="small font-italic text-muted mb-4">
                  Kecamatan = <?php echo $nama_kecamatan?><br>
                  Type Ruas = <?php echo $nama_ruas?><br>
                  Jenis Permukaan = <?php echo $jenis?>
                </div>
              </div>
            </div>
    <?php endif;?>
        <div class="card mb-2" style="margin-top:10px;">
            <h5 class="card-header">Video</h5>
            <div class="card-body">
              <div class="small font-italic text-muted mb-4">Klik Marker Map untuk Menampilkan Video</div>
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
      $('.head').click(function(){
        $(this).toggleClass('active');
        $(this).parent().find('.arrow').toggleClass('arrow-animate');
        $(this).parent().find('.content').slideToggle(280);
      });


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
                if(data.status == 200){
                  alert(data.message);
                  window.location.reload();
                }else{
                  alert(data.message);
                  return false;
                }
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
               let informasi = 'Nama Lokasi : <?php echo $value->nama_ruas_jalan?><br /> Kecamatan yang dilalui : <?php echo $value->nama_kecamatan?><br /> Type : <?php echo $value->nama_ruas?><br /><br /> Jenis Permukaan : <?php echo $value->jenis?><br /> Panjang Ruas : <?php echo $value->panjang_ruas?> km<br /> Lebar Ruas : <?php echo $value->lebar_ruas?> m<br /><br /><a href="#" class="btn btn-success" onclick="open_dialog(<?php echo $value->id_lokasi?>)">Edit atau Tambah Ruas</a> &nbsp; <a href="#" class="btn btn-danger" onclick="open_dialog_hapus(<?php echo $value->id_lokasi?>)">Hapus</a>';
                if(no==1){

                  <?php if($value->type_ruas_id==4){?>
                  var LeafIcon = L.Icon.extend({
                    options: {
                      shadowUrl: '<?php echo base_url()?>assets/img/bridge.svg',
                      iconSize:     [38, 95],
                      shadowSize:   [0, 0],
                      iconAnchor:   [12, 64],
                      shadowAnchor: [4, 59],
                      popupAnchor:  [-3, -76]
                    }
                  });

                  var greenIcon = new LeafIcon({iconUrl: '<?php echo base_url()?>assets/img/bridge.svg'});
                  //awal array
                  var a<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                  var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {icon: greenIcon}, {draggable: false}).bindPopup(informasi).addTo(map);
                <?php }else{?>
                  //awal array
                  var a<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                  var marker_a<?php echo $key?> = new L.Marker(a<?php echo $key?>, {draggable: false}).bindPopup(informasi).addTo(map);
                <?php } ?>

                }
                  //end array
                  <?php if($value->type_ruas_id==3){?>
                  if((no + 1) == (splittedArray<?php echo $key?>.length)){
                      // console.log("Last iteration with item : " + extractedLTLNG2[0]);
                      var b<?php echo $key?> = new L.LatLng(extractedLTLNG2[0], extractedLTLNG2[1]);
                      var marker_b<?php echo $key?> = new L.Marker(b<?php echo $key?>, {draggable: false}).bindPopup(informasi).addTo(map).on('click', function(e) {
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