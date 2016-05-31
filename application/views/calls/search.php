<?php 
/**
 * This view displays the search form (for a phone call)
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Search for a call</h1>

<form action="<?php echo base_url();?>calls/results" method="POST">

<label for="txtClient">Client</label>
<div class="input-group">
  <input name="txtClient" type="text" class="form-control" placeholder="Select a client" readonly="readonly">
  <span class="input-group-btn">
      <a id="cmdSelectClient" class="btn btn-info">Select</a>
  </span>
</div>

<label for="txtOperator">Call center operator</label>
<div class="input-group">
  <input name="txtOperator" type="text" class="form-control" placeholder="Select an operator" readonly="readonly">
  <span class="input-group-btn">
      <a id="cmdSelectOperator" class="btn btn-info">Select</a>
  </span>
</div>

<label for="txtDate">Date of Call</label>
<input name="txtDate" type="text" class="form-control datepicker" placeholder="Select a date" readonly="readonly">

<br />

  <button type="submit" class="btn btn-success">Search</button>
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
      <div id="frmClientSelectBody" class="modal-body">
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Select an operator -->
<div class="modal fade" id="frmSelectOperator" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select an operator</h4>
      </div>
      <div id="frmOperatorSelectBody" class="modal-body">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="operators" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12</td>
                    <td>Vichay</td>
                    <td>HENG</td>
                </tr>
                </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<link href="<?php echo base_url();?>assets/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/js/bootstrap-datepicker.min.js"></script>
<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/extensions/Select/js/dataTables.select.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //Init date picker
    $('.datepicker').datepicker();

    //On click select client, show the modal form
    $('#cmdSelectClient').click(function() {
        $('#frmSelectClient').modal('show');
        //Transform the HTML table
        $('#clients').dataTable({
            select: true
        });
    });

    //On click select operator, show the modal form
    $('#cmdSelectOperator').click(function() {
        $('#frmSelectOperator').modal('show');
        //Transform the HTML table
        $('#operators').dataTable({
            select: true
        });
    });
});

</script>
