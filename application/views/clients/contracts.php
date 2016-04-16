<?php 
/**
 * This view displays the list of contracts of a client.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Contracts of client <a href="<?php echo base_url();?>clients/22/dashboard">Georges DURAND</a></h1>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="contracts" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Contract</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td data-order="121">
            121&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>contracts/121/view" title="contract's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>contracts/22/bills" title="bills for this contract"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Car 1245XY12</td>
        <td>03/25/2016</td>
        <td>Opened</td>
    </tr>
    <tr>
        <td data-order="223">
            223&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>contracts/223/view" title="contract's details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>contracts/22/bills" title="bills for this contract"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Moto 125BC45</td>
        <td>12/23/2015</td>
        <td>Closed</td>
    </tr>
    </tbody>
</table>

  <a href="<?php echo base_url();?>contracts/create" class="btn btn-info">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create a new contract</a>

</div>

<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#contracts').dataTable({
        stateSave: true
    });
});
</script>
