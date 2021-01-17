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
    <div class="col-md-4 shadow">

    <h4 class="modal-title alert alert-success" id="exampleModalLabel">Edit Data Location</h4>
      <form action="<?php echo base_url()?>home/update_data" method="POST" id="form_modal" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" id="modal_id" name="modal_id" value="<?php echo $row->id_lokasi?>"/>
            <input id="waypoint1" name="waypoint1" type="hidden" required readonly value="<?php echo $row->waypoint1?>">
            <input id="waypoint2" name="waypoint2" type="hidden" required readonly value="<?php echo $row->waypoint2?>">
            <input type="hidden" value="0" name="id">
            <div class="form-body">
              <?php if($row->type_ruas_id==4){?>
              <div class="form-group">
                    <label class="control-labelxx col-sm-6">Nama Jembatan<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input id="nama_jembatan" name="nama_jembatan" placeholder="nama jembatan" class="form-control" type="text" required value="<?php echo $row->nama_jembatan?>">
                        <span class="help-block"></span>
                    </div>
                </div>
              <?php } ?>
                <div class="form-group">
                    <label class="control-labelxx col-sm-6">Nama Lokasi<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <input id="nama_lokasi" name="nama_lokasi" placeholder="nama_lokasi" class="form-control" type="text" required value="<?php echo $row->nama_ruas_jalan?>">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labelxx col-sm-6">Kecamatan<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                        <select name="kecamatan" class="form-control">
                           <?php foreach($master_kecamatan as $kecamatan):
                            if($kecamatan->id==$row->kecamatan_id){
                              $sel="selected";
                            }else{
                              $sel="";
                            }
                            ?>
                            <option <?php echo $sel?> value="<?php echo $kecamatan->id?>"><?php echo $kecamatan->nama?></option>
                           <?php endforeach;?>
                         </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label class="control-labelxx col-sm-6">Panjang Ruas (Km)<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                              <input id="panjang" name="panjang" placeholder="Panjang" class="form-control" type="text" required value="<?php echo $row->panjang_ruas?>">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                          <label class="control-labelxx col-sm-6">Lebar Ruas (M)<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                              <input id="lebar" name="lebar" placeholder="Lebar" class="form-control" type="text" required value="<?php echo $row->lebar_ruas?>">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label class="control-labelxx col-sm-6">Jenis Permukaan<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select name="type" class="form-control">
                               <?php foreach($master_jenis as $type):
                                if($type->id==$row->type_id){
                                  $sel="selected";
                                }else{
                                  $sel="";
                                }
                                ?>
                                <option <?php echo $sel?> value="<?php echo $type->id?>"><?php echo $type->jenis?></option>
                               <?php endforeach;?>
                             </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label class="control-labelxx col-sm-6">Panjang Jenis Permukaan (Km)<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input id="panjang_jenis" name="panjang_jenis" placeholder="Panjang Jenis Permukaan" class="form-control" type="text" required value="<?php echo $row->panjang_jenis?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-labelxx col-sm-6">Upload Video</label>
                    <div class="col-sm-12">
                        <input id="video" name="video" placeholder="Link Video" class="form-control" type="file">
                        <label class="control-labelxx col-md-12" id="modal_p_file_txt" name="modal_p_file_txt">
                          <?php echo $row->link_video?>
                        </label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <?php if($row->type_ruas_id==3){?>
                <div class="form-group">
                    <center>
                      <label class="control-labelxx col-sm-12 alert alert-success">Panjang Tiap Kondisi<span style="color:red">*</span></label>
                    </center>
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <th>Kondisi</th>
                            <th>%</th>
                            <th>Km</th>
                          </tr>
                          <?php foreach($master_kondisi as $rowx):?>
                          <tr>
                            <td nowrap><?php echo $rowx->nama?>
                              <input type="hidden" name="kondisi[]" value="<?php echo $rowx->id?>">
                            </td>
                            <td><input type="text" name="persen[]" value="<?php echo $rowx->persen?>" size="10"></td>
                            <td><input type="text" name="km[]" value="<?php echo $rowx->km?>" size="10"></td>
                          </tr>
                        <?php endforeach;?>
                        </table>
                      </div>
                    </div>
                </div>
              <?php }else{?>
                <div class="form-group">
                      <center>
                        <label class="control-labelxx col-sm-12 alert alert-success">Tipe/Kondisi<span style="color:red">*</span></label>
                      </center>
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tr>
                              <th>Kondisi</th>
                              <th>Tipe</th>
                              <th>Kondisi</th>
                            </tr>
                            <?php foreach($master_type_jembatan as $rowx):?>
                            <tr>
                              <td nowrap><?php echo $rowx->nama?>
                                <input type="hidden" name="kondisi_jembatan[]" value="<?php echo $rowx->id?>">
                              </td>
                              <td>
                                
                                <select name="tipe_detail[]">
                                  <option value=""></option>
                                  <?php foreach($master_type_jembatan_detail as $ty):
                                    if($rowx->id_type==$ty->id){
                                      $sel="selected";
                                    }else{
                                      $sel="";
                                    }
                                    ?>
                                    <option <?php echo $sel?> value="<?php echo $ty->id?>"><?php echo $ty->nama?></option>
                                  <?php endforeach;?>
                                </select>
                              </td>
                              <td><select name="kondisi_detail[]">
                                <option value=""></option>
                                  <?php foreach($master_kondisi_jembatan as $ty):
                                    if($rowx->id_kondisi_detail==$ty->id){
                                      $sel="selected";
                                    }else{
                                      $sel="";
                                    }
                                    ?>
                                    <option <?php echo $sel?> value="<?php echo $ty->id?>"><?php echo $ty->nama?></option>
                                  <?php endforeach;?>
                                </select></td>
                            </tr>
                          <?php endforeach;?>
                          </table>
                        </div>
                      </div>
                  </div>
              <?php } ?>
               <div class="modal-footer">
                <input id="modal_perimeter_list" name="modal_perimeter_list"  class="form-control" type="hidden" value="<?php echo $row->waypoint1?>">
              <input id="waypoint3" name="waypoint3"  class="form-control" type="hidden" value="<?php echo $row->waypoint2?>">
              <input id="type_ruas" name="type_ruas"  class="form-control" type="hidden" value="<?php echo $row->type_ruas_id?>">

              <div id="progress-bar" style="display:none;">
                <div class="col-xs-12">
                    <img src="<?php echo base_url(); ?>assets/img/busy.gif"/>Loading...
                </div>
              </div>

                  <!-- <button type="button" class="btn btn-md btn-success" id="clear" onclick="resetArea()">Clear Map</button> -->
                  <button type="button" class="btn btn-md btn-primary" id="btnSave" onclick="save()">Save Changes</button>
                  <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" onclick="kembali()">Back Dashboard</button>
              </div>
              <?php if($this->session->flashdata('response')):?>
              <div class="alert alert-success"> 
                <?php echo $this->session->flashdata('response');?>
              </div>
            <?php endif;?>
            </div>
        </form>
    </div>
   
</div>
<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>

   <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
      <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" rel="stylesheet" />
    <script>
         // Creating map options
         var mapOptions = {
            center: [-1.2094908817570897, 103.79153016954439],
            zoom: 16
         }
         // Creating a map object
         var map = new L.map('map4', mapOptions);
         var polyline;
         var draggableStreetMarkers = new Array();
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);
        
         // let string = "LatLng(17.50438, 1.04772),LatLng(17.48686, 1.05775)",
         let string = "<?php echo $row->waypoint2?>",
              splittedArray = string.split("LatLng"),
              outputArray = [];
           
          splittedArray.forEach(o => {
            if(o){
             let extractedLTLNG =  o.match(/\(([^)]+)\)/)[1].split(",");
             var extractedLTLNG2 = extractedLTLNG.map(parseFloat)
             
             let tempArray = [extractedLTLNG2[0], extractedLTLNG2[1]];
               outputArray.push(tempArray);
            }else{
             return;
            }
          })
          // outputArray = coordArray("<?php echo $row->waypoint1?>");
          var data = outputArray;
          console.log(data);
          var latlang = data;
          <?php if($row->type_ruas_id==3){?>
          var polyline = L.polyline(data).addTo(map);
        <?php }else{?>
          var a = new L.LatLng(<?php echo $row->waypoint1?>);
    
          var marker_a = new L.Marker(a, {draggable: false}).addTo(map);
        <?php } ?>
           /*var st_line = L.polyline(pointList, {
                    color: 'red',
                    weight: 3,
                    opacity: 0.5,
                    smoothFactor: 1
             }).addTo(mymap);
           */
         /* polyline.on('dblclick', function (e) {
              map.removeLayer(polyline)
          });*/

          // Initialise the FeatureGroup to store editable layers
var editableLayers = new L.FeatureGroup();
map.addLayer(editableLayers);

var options = {
  position: 'topleft',
  draw: {
    polygon: {
      allowIntersection: false, // Restricts shapes to simple polygons
      drawError: {
        color: '#e1e100', // Color the shape will turn when intersects
        message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
      },
      shapeOptions: {
        color: '#97009c'
      }
    },
    polyline: {
      shapeOptions: {
        color: '#f357a1',
        weight: 10
          }
    },
    // disable toolbar item by setting it to false
    polyline: true,
    circle: false, // Turns off this drawing tool
    polygon: false,
    marker: true,
    rectangle: false,
  },
  edit: {
    featureGroup: editableLayers, //REQUIRED!!
    remove: true
  }
};


          // Initialise the draw control and pass it the FeatureGroup of editable layers
            var drawControl = new L.Control.Draw(options);
            map.addControl(drawControl);

            var editableLayers = new L.FeatureGroup();
            map.addLayer(editableLayers);

            map.on('draw:created', function(e) {
              var type = e.layerType,
                layer = e.layer;
            editableLayers.addLayer(layer);
            var prm =[];
              if (type === 'polyline') {
                // console.log();
                 layer.bindPopup('A polyline!'+layer._latlngs[0].lat);
                 var jalur = layer._latlngs;
                  /*layer.on('mouseover', function() {
                        alert(layer.getLatLngs());    
                    });*/
                 prm.push(jalur);
                 console.log(prm);
                 // document.getElementById("modal_perimeter_list").value = prm;
                 var points = layer.getLatLngs();
                puncte1=points.join(',');
                puncte1=puncte1.toString();
                //puncte1 = puncte1.replace(/[{}]/g, '');
                puncte1=points.join(',').match(/([\d\.]+)/g).join(',')
                //this is the field where u want to add the coordinates
                $('#modal_perimeter_list').val(puncte1);
                $('#waypoint3').val(prm);

                //layer.bindPopup('LatLng: ' + layer.getLatLng()).openPopup();
              } else if ( type === 'polygon') {
                layer.bindPopup('A polygon!');
              } else if (type === 'marker') 
              {
                // layer.bindPopup('marker!');
                layer.bindPopup('Position : ' + layer.getLatLng()).openPopup();
                var points = layer.getLatLng();
                var lat = points.lat;
                var lng = points.lng;
               
                //this is the field where u want to add the coordinates
                $('#modal_perimeter_list').val(lat+","+lng);
                $('#waypoint3').val(points);
              }
              else if (type === 'circle') 
              {layer.bindPopup('A circle!');}
               else if (type === 'rectangle') 
              {layer.bindPopup('A rectangle!');}

              
              
            });

           function resetArea() {
            var data = [
                
                  [-1.5908134888912264, 103.6148564626511],[-1.5901393059041389, 103.613788273547]
                
            ];
            var polyline = L.polyline(data).addTo(map);
            map.removeLayer(polyline)
          }


         function coordArray(coordString) {
            var coords = coordString.split(",")
            var temp = coords.slice();
            var arr = [];

            while (temp.length) {
              arr.push(temp.splice(0,2));
            }

            return arr;
          }

          function save() {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled',true);
            var url ="<?php echo site_url('home/update_data')?>";
            var formData = new FormData($('#form_modal')[0]);

            $("#progress-bar").show();
            $("#form_div").hide();
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                  alert(data.message);
                    $('input[type=file]').val('');
                    $("#progress-bar").hide();
                    $("#form_div").show();
                  kembali();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled',false);
                    $("#progress-bar").hide();
                    $("#form_div").show();
                }
            });
        }
      </script>
</body>
</html>