<link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>   
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<br/>   
<div class="row">
    <div class="col-sm-6">Manage Users</div>
    <div class="col-sm-6 text-right">
    <?php 
    echo '<div class="form-group">
            <button class="btn btn-success" onclick="add_manageusers()">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Users</button>
          </div>'; 
    ?>
    </div>
</div>
<div class="row">
	<div class="col-sm-12">
        <div class="card">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
                <table id="table_user" style="width:100%;overflow:auto; !important" 
                class="table table-striped table-bordered data datatable">
                    <thead>
                        <tr>
                            <th style="text-align:center;">No</th>
                            <th style="text-align:center;">Username</th>
                            <th style="text-align:center;">Nama Lengkap</th>
                            <th style="text-align:center;">Created Date</th>
                			<th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/add_users');?>
<script type="text/javascript">

$(document).ready(function() {
    refresh_list();
});

function add_manageusers() {
    save_method = 'add';
    $('#form_modal_popup')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form_popup').modal('show');
    // $('.modal-title_popup').text('Add Users');
}

function refresh_list(){
	datatables();
}

function datatables(){
	table_user = $('#table_user').DataTable({
        "bDestroy": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "dataSrc": "",
        "bPaginate": true,
        "searching": true,
        "paging": true,
        "info": true,
        "dom": 'Bfrtip',
        "ajax": {
        	"url": "<?php echo site_url().'admin/ajax_list/'?>",
            "type": "POST"
        },
        "columnDefs": [
       	 { "orderable": true, "targets": 0, "className": "text-right"},
       	 { "orderable": true, "targets": 1, "className": "text-left" },
       	 { "orderable": true, "targets": 2, "className": "text-center"},
       	 { "orderable": true, "targets": 3, "className": "text-center"},
       ],
    });
}

function reset_password(id, fs) {
    /*if(confirm('Apa Anda Yakin Reset Passsword untuk User '+fs+' ?')) {
        $.ajax({
            url : "<?php echo site_url('admin/ajax_reset')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
             	alert(data.message);
                refresh_list();
            },
            error: function (jqXHR, textStatus, errorThrown) {
            	 alert(data.message);
            }
        });
    }*/
    if(confirm('Apa Anda Yakin Hapus data untuk User '+fs+' ?')) {
        $.ajax({
            url : "<?php echo site_url('admin/ajax_manageusers_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                alert(data.message);
                refresh_list();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                 alert(data.message);
            }
        });
    }
}
</script>