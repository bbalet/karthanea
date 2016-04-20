<?php 
/**
 * This view allows to edit a Call
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Edit Call #<span class="text-muted">44</span></h1>

<form action="<?php echo base_url();?>calls/index" method="POST">

<label for="txtClient">Client</label>
<div class="input-group">
  <input name="txtClient" type="text" class="form-control" value="Georges DURAND" readonly="readonly">
  <span class="input-group-btn">
      <a id="cmdSelectClient" class="btn btn-info">Select</a>
  </span>
</div>

<label for="txtDate">Date of Call</label>
<input name="txtDate" type="text" class="form-control" value="04/20/2016" readonly="readonly">

<label for="txtOperator">Call center operator</label>
<input name="txtOperator" type="text" class="form-control" value="Vichay HENG" readonly="readonly">

<label for="time">Duration of the call</label>
<input name="txtDuration" type="text" class="form-control" value="00:15:00" readonly="readonly">

<label for="editor">Details about the call</label>
<textarea name="editor" id="editor" rows="10" cols="80">
    This is my textarea to be replaced with CKEditor.
</textarea>

<br />

  <button type="submit" class="btn btn-success">Update</button>
</form>

</div>

<!-- Select a client -->
<div class="modal fade" id="frmSelectClient" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select a client</h4>
      </div>
      <div id="frmTestSelectBody" class="modal-body">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="clients" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Contracts</th>
                </tr>
            </thead>
            <tbody>
	            <tr>
	            	<td>22</td>
	                <td>Georges</td>
	                <td>DURAND</td>
	                <td>Car 1245XY12<br />
	                Moto 125BC45
	                </td>
	            </tr>
	            <tr>
	            	<td>33</td>
	                <td>Benjamin</td>
	                <td>BALET</td>
	                <td>Car 5368AB13
	                </td>
	            </tr>
                </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="cmdAddTest" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<link href="<?php echo base_url();?>assets/ckeditor/contents.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	//Create editor
	CKEDITOR.replace( 'editor' );

	//On click select client, show the modal form
    $('#cmdSelectClient').click(function() {
        $('#frmSelectClient').modal('show');
        //Transform the HTML table
    	$('#clients').dataTable();
    });
});

</script>
