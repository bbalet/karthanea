<?php
/**
 * This view lists the users
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<div class="row-fluid">
    <div class="col-md-12">
        
<h1>List of users</h1>

<?php echo $flash_partial_view;?>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="users" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Login</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($users as $users_item): ?>
    <tr>
        <td data-order="<?php echo $users_item['id']; ?>">
            <?php echo $users_item['id'] ?>
            <div class="pull-right">
                <a href="<?php echo base_url();?>users/edit/<?php echo $users_item['id'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="<?php echo $users_item['id'];?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                &nbsp;
                <a href="#" class="reset-pwd" data-id="<?php echo $users_item['id'];?>" title="Reset password"><span class="glyphicon glyphicon-lock"></span></a>
            </div>
        </td>
        <td><?php echo $users_item['firstname'] ?></td>
        <td><?php echo $users_item['lastname'] ?></td>
        <td><?php echo $users_item['login'] ?></td>
        <td><a href="mailto:<?php echo $users_item['email']; ?>"><?php echo $users_item['email']; ?></a></td>
    </tr>
<?php endforeach ?>
	</tbody>
</table>
	</div>
</div>

<div class="row-fluid">
    <div class="col-md-12">&nbsp;</div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
      <a href="<?php echo base_url();?>users/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign glyphicon-white"></span>&nbsp;Create a new user</a>
    </div>
</div>

</div>

<div id="frmResetPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h3>Reset password</h3>
            </div>
            <div id="frmResetPwdBody" class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal hide" id="frmModalAjaxWait" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
            <h1>Please wait</h1>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url();?>assets/images/loading.gif"  align="middle">
        </div>
 </div>

<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#users').dataTable({
		stateSave: true
    });
    
    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("Are you sure that you want to delete this user?", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>users/delete/' + id;
            }
        });
    });
    
    $('.reset-pwd').click(function() {
        var id = $(this).data('id');
        $('#frmModalAjaxWait').modal('show');
        $("#frmResetPwdBody").load('<?php echo base_url();?>users/reset/' + id, function(){
            $('#frmModalAjaxWait').modal('hide');
            $('#frmResetPwd').modal('show'); 
        });
    });
    $('#frmResetPwd').on('hidden', function() {
        $(this).removeData('modal');
    });
});
</script>
