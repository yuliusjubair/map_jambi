<style type="text/css">
  .column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
 


<form method="POST" id="form-images" class="form-horizontal" enctype="multipart/form-data">
  <input type="hidden" name="id_lokasi" id="id_lokasi" value="<?php echo $id?>">
<div class="container">
  <div class="rowx">
  <div class="column"> 
      <!-- <label class="control-label">Upload Images</label> -->
      <input id="images" name="images" placeholder="File Image" class="form-control" type="file" accept="image/*"></div>
  <div class="column">
    &nbsp;<button type="button" class="btn btn-md btn-primary" id="btnSave" onclick="save_upload()">Upload</button>
  </div>
</div>
</div>
<div class="row"><hr></div>
<div class="form-group">
  <div class="col-sm-12">
    <div class="table-responsive">
      <table id="table" class="display" class="table table-striped table-bordered data">
        <thead>
        <tr>
          <th>No</th>
          <th>Images</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
</form>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({ 
            "dom": 'Bfrtip',
            "bFilter": false,
            "processing": true, 
            "serverSide": false, 
            "ordering": false,
            "ajax": {
                "url": "<?php echo site_url('index.php/Home/list_images').'/'.$id?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "orderable": false, 
                },
            ],
        });
    });

    function save_upload(){
       $('#btnSave').text('Saving...');
       $('#btnSave').attr('disabled',true);
          var url;
        url = "<?php echo site_url('index.php/Home/ajax_insert_images')?>";

          var formData = new FormData($('#form-images')[0]);
          $.ajax({
              url : url,
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function(data) {
              refresh_list();
                  $('#btnSave').text('Save');
                  $('#btnSave').attr('disabled',false);
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  alert('Error adding / update data' + errorThrown);
                  $('#btnSave').text('Save');
                  $('#btnSave').attr('disabled',false);
              }
        });  
      // 
    }

     function refresh_list(){
       table = $('#table').DataTable({ 
            "bDestroy": true,
             "dom": 'Bfrtip',
             "bFilter": false,
            "processing": true, 
            "serverSide": false, 
            "ordering": false,
            "ajax": {
                "url": "<?php echo site_url('index.php/Home/list_images').'/'.$id?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "orderable": false, 
                },
            ],
        });
    }
</script>