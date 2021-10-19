<style type="text/css">
	#map2 { margin: 0; height: 100%; width: 100%; }
</style>
<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" rel="stylesheet" />

 <!-- <div class="mapcanvas" id="map2" style="height: 650px"></div> -->
<div class="row">
   <div class="col-md-8">
        <div class="card">
            <div class="mapcanvas" id="map2" style="height: 650px">
                <div id="popup"></div>
            </div>   
        </div>
    </div>
    <div class="col-md-4 shadow">

    <h4 class="modal-title alert alert-success" id="exampleModalLabel">Add Data Location</h4>
      <form action="<?php echo base_url()?>index.php/home/add_data" method="POST" id="form_id" class="form-horizontal" novalidate>
            <input type="hidden" id="modal_id" name="modal_id" value="<?php //echo $row->id_lokasi?>"/>
            <input id="waypoint1" name="waypoint1" type="hidden" required readonly value="<?php //echo $row->waypoint1?>">
            <input id="waypoint2" name="waypoint2" type="hidden" required readonly value="<?php //echo $row->waypoint2?>">
            <input type="hidden" value="0" name="id">
            <div class="form-body">
              <div class="form-group">
                    <label class="control-labelxx col-sm-1">Type<span style="color:red">*</span></label>
                    <div class="col-sm-12">
                         <select name="type_ruas" id="type_ruas" class="form-control">
                           <?php foreach($master_type as $t):?>
                            <option value="<?php echo $t->id?>"><?php echo $t->nama?></option>
                           <?php endforeach;?>
                         </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="ruas_jalan">
                  <div class="form-group">
                      <label class="col-sm-6">Nama Ruas Jalan<span style="color:red">*</span></label>
                      <div class="col-sm-12">
                          <input id="nama_lokasi" name="nama_lokasi" placeholder="nama ruas jalan" class="form-control" type="text" required>
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-labelxxxx col-sm-6">Kecamatan yang dilalui<span style="color:red">*</span></label>
                      <div class="col-sm-12">
                          <!-- <input id="kecamatan" name="kecamatan" placeholder="Kecamatan" class="form-control" type="text" required value="<?php //echo $row->nama_lokasi?>">
                           -->
                           <select name="kecamatan" class="form-control">
                             <?php foreach($master_kecamatan as $kecamatan):?>
                              <option value="<?php echo $kecamatan->id?>"><?php echo $kecamatan->nama?></option>
                             <?php endforeach;?>
                           </select>
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label class="control-labelxxxx col-sm-6">Panjang Ruas (Km)<span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <input id="panjang" name="panjang" placeholder="Panjang" class="form-control" type="text" required value="<?php //echo $row->alamat?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <label class="control-labelxxxx col-sm-6">Lebar Ruas (M)<span style="color:red">*</span></label>
                            <div class="col-sm-6  ">
                                <input id="lebar" name="lebar" placeholder="Lebar" class="form-control" type="text" required value="<?php //echo $row->alamat?>">
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
                          <label class="control-labelxxx col-sm-6">Jenis Permukaan<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                             
                              <select name="type" class="form-control">
                                 <?php foreach($master_jenis as $type):?>
                                  <option value="<?php echo $type->id?>"><?php echo $type->jenis?></option>
                                 <?php endforeach;?>
                               </select>
                              <span class="help-block"></span>
                          </div>
                      </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="control-labelxxxx col-sm-6">Panjang Jenis Permukaan (Km)<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                              <input id="panjang_jenis" name="panjang_jenis" placeholder="Panjang Jenis Permukaan" class="form-control" type="text" required value="<?php //echo $row->panjang_jenis?>">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <center>
                        <label class="control-labelxxxx col-sm-12 alert alert-success">Panjang Tiap Kondisi<span style="color:red">*</span></label>
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
                              <td><input type="text" name="persen[]" size="10"></td>
                              <td><input type="text" name="km[]" size="10"></td>
                            </tr>
                          <?php endforeach;?>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                </div>
                <div class="jembatan">
                   <div class="form-group">
                      <label class="control-labelxx col-sm-6">Nama Jembatan<span style="color:red">*</span></label>
                      <div class="col-sm-12">
                          <input id="nama_jembatan" name="nama_jembatan" placeholder="nama jembatan" class="form-control" type="text" required>
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-labelxx col-sm-6">Nama Ruas Jalan<span style="color:red">*</span></label>
                      <div class="col-sm-12">
                          <input id="nama_lokasi_jembatan" name="nama_lokasi_jembatan" placeholder="nama ruas jalan" class="form-control" type="text" required>
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-labelxx col-sm-12">Kecamatan yang dilalui<span style="color:red">*</span></label>
                      <div class="col-sm-12">
                          <!-- <input id="kecamatan" name="kecamatan" placeholder="Kecamatan" class="form-control" type="text" required value="<?php //echo $row->nama_lokasi?>">
                           -->
                           <select name="kecamatan" class="form-control">
                             <?php foreach($master_kecamatan as $kecamatan):?>
                              <option value="<?php echo $kecamatan->id?>"><?php echo $kecamatan->nama?></option>
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
                                <input id="panjang_jembatan" name="panjang_jembatan" placeholder="Panjang" class="form-control" type="text" required value="<?php //echo $row->alamat?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <label class="control-labelxx col-sm-6">Lebar Ruas (M)<span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <input id="lebar_jembatan" name="lebar_jembatan" placeholder="Lebar" class="form-control" type="text" required value="<?php //echo $row->alamat?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <!-- <div class="col">
                        <div class="form-group">
                          <label class="control-labelxx col-sm-6">Jenis Permukaan<span style="color:red">*</span></label>
                          <div class="col-sm-12">
                              <select name="type" class="form-control">
                                 <?php foreach($master_jenis as $type):?>
                                  <option value="<?php echo $type->id?>"><?php echo $type->jenis?></option>
                                 <?php endforeach;?>
                               </select>
                              <span class="help-block"></span>
                          </div>
                      </div>
                      </div> -->
                      <div class="col">
                        <div class="form-group">
                          <label class="control-labelxx col-sm-8">Jumlah Bentang<span style="color:red">*</span></label>
                          <div class="col-sm-12">
                              <input id="jumlah_bentang" name="jumlah_bentang" placeholder="Jumlah bentang" class="form-control" type="text" required value="<?php //echo $row->panjang_jenis?>">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                  </div>
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
                                  <?php foreach($master_type_jembatan_detail as $ty):?>
                                    <option value="<?php echo $ty->id?>"><?php echo $ty->nama?></option>
                                  <?php endforeach;?>
                                </select>
                              </td>
                              <td><select name="kondisi_detail[]">
                                  <?php foreach($master_kondisi as $ty):?>
                                    <option value="<?php echo $ty->id?>"><?php echo $ty->nama?></option>
                                  <?php endforeach;?>
                                </select></td>
                            </tr>
                          <?php endforeach;?>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              <input id="modal_perimeter_list" name="modal_perimeter_list"  class="form-control" type="hidden">
              <input id="waypoint3" name="waypoint3"  class="form-control" type="hidden">
               <div class="modal-footer">
                <button type="button" class="btn btn-md btn-primary" id="btnSave" onClick="placeOrder(this.form)">Save Changes</button>
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" onclick="kembali()">Back to Dashboard</button>
            </div>
            </div>
        </form>
    </div>
   
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('.jembatan').hide();
    $('#type_ruas').on('change', function() {
        var pilih = $(this).val();
        if(pilih == 3){
            $('.ruas_jalan').show();
            $('.jembatan').hide();
        } else if(pilih==4){
          console.log(pilih);
            $('.ruas_jalan').hide();
            $('.jembatan').show();
        }
    });
})  
	// center of the map
var center = [-1.2094908817570897, 103.79153016954439];

// Create the map
var map = L.map('map2').setView(center,15);

// Set up the OSM layer
L.tileLayer(
  'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
    maxZoom: 18
  }).addTo(map);

<?php foreach ($row as $key => $value) { ?>
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
            }else{
             return;
            }
          })
          var data<?php echo $key?> = outputArray<?php echo $key?>;
          var polyline = L.polyline(data<?php echo $key?>).addTo(map);

    <?php }?>  

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

 function placeOrder(form){
        var wp1 = $("#modal_perimeter_list").val();
        var nama_lokasi = $("#nama_lokasi").val();
        if(wp1==""){
          alert('Anda Belum Menentukan Titik Point Map');
          return false;
        }else{
          /*// form.submit();
          if(nama_lokasi==""){
            return false;
          }else{*/
           document.getElementById("form_id").submit();
          //}
        }
    }
</script>