<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_popup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Users Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br />
            </div>
            <div class="modal-body form">
                <form action="#" id="form_modal_popup" class="form-horizontal">
                    <input type="hidden" value="0" id="modal_id" name="modal_id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-labelxx col-sm-6">Username<span style="color:red">*</span></label>
                            <div class="col-sm-12">
                                <input id="modal_username" name="modal_username" placeholder="Username" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
					<div class="form-body">
                        <div class="form-group">
                            <label class="control-labelxx col-sm-6">Password<span style="color:red">*</span></label>
                            <div class="col-sm-12">
                                <input id="modal_password" name="modal_password" placeholder="Password" class="form-control" type="password" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
					<div class="form-body">
                        <div class="form-group">
                            <label class="control-labelxx col-sm-6">Name<span style="color:red">*</span></label>
                            <div class="col-sm-12">
                                <input id="modal_name" name="modal_name" placeholder="Name" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-primary" id="btnSave" onclick="save()" >Save</button>
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" onclick="cancel()">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script type="text/javascript">
	function save() {
    $('#btnSave').text('Saving...');
    $('#btnSave').attr('disabled',true);
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('index.php/admin/ajax_manageusers_add')?>";
    } else {
        url = "<?php echo site_url('index.php/admin/ajax_manageusers_update')?>";
    }

    var formData = new FormData($('#form_modal_popup')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
            //alert(data.message);
            if(data.status) {
                $('#modal_form_popup').modal('hide');
                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled',false);
                refresh_list();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled',false); 
                refresh_list();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false); 
        }
    });
}
</script>