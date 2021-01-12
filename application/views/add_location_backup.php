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
            <div class="mapcanvas" id="map4" style="height: 650px">
                <div id="popup"></div>
            </div>   
        </div>
    </div>
    <div class="col-md-4 shadow" style="padding:5px; border-radius:5px;">

    <h5 class="modal-title" id="exampleModalLabel">Add Data Location</h5>
      <form action="<?php echo base_url()?>home/add_data" method="POST" id="form_modal" class="form-horizontal">
            <input type="hidden" id="modal_id" name="modal_id" value="<?php //echo $row->id_lokasi?>"/>
            <input id="waypoint1" name="waypoint1" type="hidden" required readonly value="<?php //echo $row->waypoint1?>">
            <input id="waypoint2" name="waypoint2" type="hidden" required readonly value="<?php //echo $row->waypoint2?>">
            <input type="hidden" value="0" name="id">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-sm-6">Nama Lokasi<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input id="nama_lokasi" name="nama_lokasi" placeholder="nama_lokasi" class="form-control" type="text" required value="<?php //echo $row->nama_lokasi?>">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6">Alamat<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input id="alamat" name="alamat" placeholder="Alamat" class="form-control" type="text" required value="<?php //echo $row->alamat?>">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6">Keterangan<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <textarea id="keterangan" name="keterangan" placeholder="Keterangan" class="form-control" required><?php //echo $row->keterangan?></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6">Link Video</label>
                    <div class="col-sm-12">
                        <input id="link_video" name="link_video" placeholder="Link Video" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
               <div class="modal-footer">
                <button type="submit" class="btn btn-md btn-primary" id="btnSave" onClick="placeOrder(this.form)">Save Changes</button>
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" onclick="kembali()">Back</button>
            </div>
            </div>
        </form>
    </div>
   
</div>
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

    function placeOrder(form){
        var wp1 = $("#waypoint1").val();
        var wp2 = $("#waypoint2").val();
        if(wp1=="" && wp2==""){
          alert('Anda Belum Menentukan Titik Point Map');
          return false;
        }else{
          form.submit();
        }
    }
    
     var endPointLocation = new L.LatLng(-1.5901393059041389, 103.613788273547);
    var map4 = new L.Map("map4", {
      center: endPointLocation,
      zoom: 16,
      layers: new L.TileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png")
    });

   /* var map4 = new L.Map('map4', {
      'center': [0, 0],
      'zoom': 14,
      'layers': [
        L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
        })
      ]
    });*/

        
    var wp1 = $("#waypoint1").val();
    var wp2 = $("#waypoint2").val();
    
    var a = new L.LatLng(-1.5901393059041389, 103.613788273547);
    var b = new L.LatLng(-1.5908134888912264, 103.6148564626511);
    
     var marker_a = new L.Marker(a, {draggable: true}).addTo(map4),
        marker_b = new L.Marker(b, {draggable: true}).addTo(map4);
    
    var data = [
      [
        [-1.5908134888912264, 103.6148564626511],[-1.5901393059041389, 103.613788273547]
      ]
  ];
// console.log(data);

    /* var polyline = L.polyline([
      <?php foreach ($row as $key => $value) { ?>
        [[<?php echo $value->waypoint1?>, <?php echo $value->waypoint2?>]],
      <?php } ?>
      ]).addTo(map);*/
      var polyline = new L.Polyline([a, b]).addTo(map4);

     /* data.forEach(function (points) {

        var polyline = L.polyline(
          points, {
            weight: 6,
            clickable: true
          }
        ).addTo(map4);
        
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

      marker_a.on('dragend', function (e) {
          // document.getElementById('latitude').value = marker.getLatLng().lat;
          // alert("marker 1 : "+marker_a.getLatLng().lat);
          $("#waypoint1").val(marker_a.getLatLng().lat+","+marker_a.getLatLng().lng);
        });

      marker_b.on('dragend', function (e) {
          // document.getElementById('latitude').value = marker.getLatLng().lat;
          // alert("marker 2 : "+marker_a.getLatLng().lng);
          $("#waypoint2").val(marker_b.getLatLng().lat+","+marker_b.getLatLng().lng);
        });

        marker_a
            .on('dragstart', dragStartHandler)
            .on('drag', dragHandler)
            .on('dragend', dragEndHandler);

        marker_b
            .on('dragstart', dragStartHandler)
            .on('drag', dragHandler)
            .on('dragend', dragEndHandler);

        function dragStartHandler (e) {
            var latlngs = polyline.getLatLngs(),
                latlng = this.getLatLng();
            for (var i = 0; i < latlngs.length; i++) {
                if (latlng.equals(latlngs[i])) {
                    this.polylineLatlng = i;
                }
            }
        }

        function dragHandler (e) {
            var latlngs = polyline.getLatLngs(),
                latlng = this.getLatLng();
            latlngs.splice(this.polylineLatlng, 1, latlng);
            polyline.setLatLngs(latlngs);
            // $("#waypoint1").val(latlng);
        }

        function dragEndHandler (e) {
            delete this.polylineLatlng;
        }

        function kembali(){
            window.location.href="<?php echo base_url()?>home/show_draw/";
        }
    </script>
</body>
</html>