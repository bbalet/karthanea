<?php 
/**
 * This view displays the result of a search request.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Search results</h1>

<p>According to your search request, we've found <span class="text-muted">4</span> results</p>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="clients" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td data-order="22">
            22&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>clients/22/dashboard" title="client's dashboard"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/22/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/22/contracts" title="client's contracts"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/22/bills" title="client's bills"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Georges</td>
        <td>DURAND</td>
        <td>gdurand@test.org</td>
    </tr>
    <tr>
        <td data-order="33">
            33&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>clients/33/dashboard" title="client's dashboard"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/33/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/33/contracts" title="client's contracts"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/33/bills" title="client's bills"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Benjamin</td>
        <td>BALET</td>
        <td>bbalet@test.org</td>
    </tr>
    <tr>
        <td data-order="35">
            35&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>clients/35/dashboard" title="client's dashboard"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/35/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/35/contracts" title="client's contracts"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                &nbsp;<a href="<?php echo base_url();?>clients/35/bills" title="client's bills"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Benoît</td>
        <td>PITET</td>
        <td>bpitet@test.org</td>
    </tr>
    </tbody>
</table>

</div>


<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#clients').dataTable({
        stateSave: true
    });
});
</script>
