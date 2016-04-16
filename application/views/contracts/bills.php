<?php 
/**
 * This view displays the list of bills of a contract.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Bills of contract <a href="<?php echo base_url();?>contracts/22/view">Car 1245XY12</a></h1>

<p>Client <a href="<?php echo base_url();?>clients/22/dashboard">Georges DURAND</a></p>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="bills" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Due Date</th>
            <th>Total due</th>
            <th>Total paid</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td data-order="423">
            423&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>bills/423/view" title="bill's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="423" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>03/25/2016</td>
        <td>03/31/2016</td>
        <td>25 $</td>
        <td>0 $</td>
        <td>Opened</td>
    </tr>
    <tr>
        <td data-order="321">
            321&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>bills/321/view" title="bill's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="321" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>02/24/2016</td>
        <td>02/28/2016</td>
        <td>25 $</td>
        <td>0 $</td>
        <td>Late</td>
    </tr>
    <tr>
        <td data-order="123">
            123&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>bills/123/view" title="bill's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="123" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>01/24/2016</td>
        <td>01/31/2016</td>
        <td>25 $</td>
        <td>25 $</td>
        <td>Closed</td>
    </tr>
    <tr>
        <td data-order="97">
            97&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>bills/97/view" title="bill's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="97" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>12/23/2015</td>
        <td>12/31/2015</td>
        <td>25 $</td>
        <td>25 $</td>
        <td>Closed</td>
    </tr>
    </tbody>
</table>

  <a href="<?php echo base_url();?>bills/create" class="btn btn-info">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create a new bill</a>

</div>

<div class="modal fade" id="frmConfirmDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete a bill</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to delete this bill?</p>
      </div>
      <div class="modal-footer">
        <a type="button" id="lnkDeleteUser" href="#" class="btn btn-danger" data-dismiss="modal">Yes</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#bills').dataTable({
        stateSave: true
    });

	
    //On showing the confirmation pop-up, add the bill id at the end of the delete url action
    $('#frmConfirmDelete').on('show.bs.modal', function() {
        var link = "<?php echo base_url();?>clients/1/bills/" + $(this).data('id') + "/delete";
        $("#lnkDeleteUser").attr('href', link);
    });

    //Display a modal pop-up so as to confirm if a bill has to be deleted or not
    //We build a complex selector because datatable does horrible things on DOM...
    //a simplier selector doesn't work when the delete is on page >1 
    $("#bills tbody").on('click', '.confirm-delete',  function(){
        var id = $(this).data('id');
        $('#frmConfirmDelete').data('id', id).modal('show');
    });
});
</script>
