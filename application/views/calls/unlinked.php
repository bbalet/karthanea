<?php 
/**
 * This view displays the list of calls that are not linked to any client
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Unlinked calls</h1>

<p>The calls of this list are not linked to any client</p>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="calls" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Operator</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td data-order="44">
            44&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>calls/44/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Vichay HENG</td>
        <td>04/20/2016</td>
    </tr>
    <tr>
        <td data-order="55">
            55&nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>calls/55/edit" title="edit client"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            </div>
        </td>
        <td>Vichay HENG</td>
        <td>04/25/2016</td>
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
