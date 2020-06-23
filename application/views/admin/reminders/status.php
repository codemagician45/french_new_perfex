<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal fade" id="status" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <?php echo form_open(admin_url('misc/reminder_status'), array('id'=>'reminders-status-form')); ?>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
               <span class="edit-title"><?php echo _l('edit_status'); ?></span>
               <span class="add-title"><?php echo _l('reminder_new_status'); ?></span>
            </h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div id="additional"></div>
                  <?php echo render_input('name', 'reminders_status_add_edit_name'); ?>
                  <?php echo render_color_picker('color', _l('reminders_status_color')); ?>
                  <?php echo render_input('statusorder', 'reminders_status_add_edit_order', total_rows(db_prefix().'reminders_status') + 1, 'number'); ?>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
            <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
         </div>
      </div>
      <!-- /.modal-content -->
      <?php echo form_close(); ?>
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
  window.addEventListener('load', function () {
    appValidateForm($("body").find('#reminders-status-form'), {
        name: 'required'
    }, manage_reminders_statuses);
    $('#status').on("hidden.bs.modal", function (event) {
        $('#additional').html('');
        $('#status input[name="name"]').val('');
        $('#status input[name="color"]').val('');
        $('#status input[name="statusorder"]').val('');
        $('.add-title').removeClass('hide');
        $('.edit-title').removeClass('hide');
        $('#status input[name="statusorder"]').val($('table tbody tr').length + 1);
    });
});

// Create lead new status
function new_status() {
    $('#status').modal('show');
    $('.edit-title').addClass('hide');
}

// Edit status function which init the data to the modal
function edit_status(invoker, id) {
    $('#additional').append(hidden_input('id', id));
    $('#status input[name="name"]').val($(invoker).data('name'));
    $('#status .colorpicker-input').colorpicker('setValue', $(invoker).data('color'));
    $('#status input[name="statusorder"]').val($(invoker).data('order'));
    $('#status').modal('show');
    $('.add-title').addClass('hide');
}

// Form handler function for reminders status
function manage_reminders_statuses(form) {
    var data = $(form).serialize();
    var url = form.action;
    $.post(url, data).done(function (response) {
        window.location.reload();
    });
    return false;
}
</script>
