<?php 
/**
 * This view displays the result of a search request (calls).
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Search results</h1>

<p>According to your search request, we've found <span class="text-muted">4</span> results</p>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="calls" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td data-order="44">
            44&nbsp;
            <div class="pull-right">
                &nbsp;<a href="<?php echo base_url();?>calls/22/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Georges</td>
        <td>DURAND</td>
        <td>04/20/2016</td>
    </tr>
    <tr>
        <td data-order="33">
            33&nbsp;
            <div class="pull-right">
                &nbsp;<a href="<?php echo base_url();?>calls/22/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Benjamin</td>
        <td>BALET</td>
        <td>02/01/2016</td>
    </tr>
    </tbody>
</table>

</div>


<link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#calls').dataTable({
        stateSave: true
    });
});
</script>
