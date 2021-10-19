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
      <form action="<?php echo base_url()?>index.php/home/update_data" method="POST" id="form_modal" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" id="modal_id" name="modal_id" value="<?php echo $row->id_lokasi?>"/>
            <input id="waypoint1" name="waypoint1" type="hidden" required readonly value="<?php echo $row->waypoint1?>">
            <input id="waypoint2" name="waypoint2" type="hidden" required readonly value="<?php echo $row->waypoint2?>">
            <input type="hidden" value="0" name="id">
            <div class="form-body">
              <!--  -->
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="col-sm-6">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-3">
                          <a href="#" onclick="form_upload_images('<?php echo $row->id_lokasi?>', '<?php echo $row->nama_ruas_jalan?>')" class="btn btn-primary" href="">Upload Images</a>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="col-sm-6">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-3">
                          <a href="#" onclick="form_link_video('<?php echo $row->id_lokasi?>', '<?php echo $row->nama_ruas_jalan?>')" class="btn btn-primary" href="">Link Video</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                
                <?php if($row->type_ruas_id==3){?>
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
                <div class="row alert alert-warning">
                  <div class="text-sm font-weight-bold text-success text-uppercase mb-3">
                    <a href="#" onclick="view_jenis_permukaan('<?php echo $row->id_lokasi?>', '<?php echo $row->nama_ruas_jalan?>','<?php echo $row->type_ruas_id?>')" class="link" href="">lihat detail jenis permukaan</a>
                  </div>
                </div>
              <?php } ?>

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

<div class="modal fade" id="modal_form_popup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">View Jenis Permukaan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br />
            </div>
            <div class="modal-body form">
              <div class="table-responsive upload_images">
                <form action="#" id="form_detail_jenis" class="form-horizontal">
                  <!--   <table class="table table-bordered">
                      <tr>
                        <th>No</th>
                        <th>Jenis Permukaan</th>
                        <th>Panjang (Km)</th>
                      </tr>
                    </table> -->
                </form>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>

   <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
      <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" rel="stylesheet" />
<link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>  
    <script>

      function view_jenis_permukaan(id, $nama, id_ruas) {
        $.ajax({
            url : "<?php echo site_url('index.php/home/view_jenis_permukaan')?>/"+id+"/"+id_ruas,
            type: "GET",
            dataType: "html",
            success: function(data) {
              $('.upload_images').html('');
               $('#form_detail_jenis').html('');
               $('#form_detail_jenis').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)  {
                alert('Error get data from ajax'+jqXHR.responseText);
            }
        });

          $('#modal_form_popup').modal('show');
          $('.modal-title').text('View Jenis Permukaan : ' + $nama);
      }

      function form_upload_images(id, nama) {
        $.ajax({
            url : "<?php echo site_url('index.php/home/form_upload_images')?>/"+id,
            type: "GET",
            dataType: "html",
            success: function(data) {
              $('.modal-title').text('Upload Images Ruas Jalan/Jembatan : ' + nama);
               $('.upload_images').html('');
               $('.upload_images').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)  {
                alert('Error get data from ajax'+jqXHR.responseText);
            }
        });

          $('#modal_form_popup').modal('show');
          
      }

      function hapus_images(id, file){
      if(confirm('Are you sure Delete this Image?')) {
        $.ajax({
            url : "<?php echo site_url('index.php/home/hapus_images')?>/"+id+"/"+file,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if(data.status == 200){
                  alert(data.message);
                  refresh_list();
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

    function form_link_video(id, nama) {
        $.ajax({
            url : "<?php echo site_url('index.php/home/form_link_video')?>/"+id,
            type: "GET",
            dataType: "html",
            success: function(data) {
              $('.modal-title').text('Link Video Ruas Jalan/Jembatan : ' + nama);
               $('.upload_images').html('');
               $('.upload_images').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)  {
                alert('Error get data from ajax'+jqXHR.responseText);
            }
        });

          $('#modal_form_popup').modal('show');
          
      }

		function hapus_link(id, file){
      if(confirm('Are you sure Delete this Link?')) {
        $.ajax({
            url : "<?php echo site_url('index.php/home/hapus_link')?>/"+id+"/"+file,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if(data.status == 200){
                  alert(data.message);
                  refresh_list();
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
		<?php 
			$point1=explode(',',$row->waypoint1);
			$point1=$point1[0];
			
			$point2=explode(',',$row->waypoint2);
			$point2=str_replace(")"," ",$point2[count($point2)-1]);
		?>
		//console.log(<?php echo $point1?>, <?php echo $point2?>);
         // Creating map options
         var mapOptions = {
            //center: [-1.2094908817570897, 103.79153016954439],
			center: [<?php echo "-".$point1?>, <?php echo $point2?>],
            zoom: 12
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
          //console.log(data);
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
		  
		  polyline.setStyle({
			color: 'red'
		});

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
            var url ="<?php echo site_url('index.php/home/update_data')?>";
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