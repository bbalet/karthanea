<?php
/**
 * This view displays a bill
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

    <h1>View a bill</h1>

    <p>Client : <a target="_blank" href="<?php echo base_url(); ?>clients/22/dashboard">Georges DURAND</a></p>
    <p>Contract : <a target="_blank" href="<?php echo base_url(); ?>contracts/121/view">Car 1245XY12</a></p>
    <p>Date : <span class="text-muted">1 April 2016</span></p>
    <p>Due Date : <span class="text-muted">10 April 2016</span></p>
    <p>Total : <span class="text-muted">10 $</span></p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Desciption</th>
                <th>Qty</th>
                <th>Unit price</th>
                <th>Total price</th>
            </tr>	
        </thead>
        <tbody>
            <tr>
                <td>Monthly subscription</td>
                <td>1</td>
                <td>10 $</td>
                <td>10 $</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>TOTAL</strong></td>
                <td><strong>10 $</strong></td>
            </tr>
        </tbody>
    </table>

    <a href="<?php echo base_url(); ?>clients/22/bills" class="btn btn-info">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;Back to list of bills</a>
    &nbsp;

    <a href="<?php echo base_url(); ?>bills/<?php echo 1; ?>/export" target="_blank" class="btn btn-primary">
        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>&nbsp;Export</a>
    &nbsp;
    <a href="<?php echo base_url(); ?>bills/<?php echo 22; ?>/edit" class="btn btn-primary">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Edit</a>

</div>
