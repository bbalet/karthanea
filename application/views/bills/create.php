<?php 
/**
 * This view allows to create a new Bill
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Create a new Bill</h1>

<p>Client : <a target="_blank" href="<?php echo base_url();?>clients/22/dashboard">Georges DURAND</a></p>
<p>Contract : <a target="_blank" href="<?php echo base_url();?>contracts/121/view">Car 1245XY12</a></p>

<form action="<?php echo base_url();?>bills/create" method="POST">

<label for="cboStatus">Status:</label>
<select id="cboStatus" name="cboStatus" class="form-control">
    <option>Opened</option>
    <option>Closed</option>
    <option>Pending payment</option>
    <option>Late</option>
    <option>Cancelled</option>
</select>

<label for="txtDate">Date : </label>
<input name="txtDate" id="txtDate" type="text" class="form-control datepicker" readonly="readonly">

<label for="txtDueDate">Due Date : </label>
<input name="txtDueDate" id="txtDueDate" type="text" class="form-control datepicker" placeholder="Select a date for payment" readonly="readonly">

<label for="txtTotalDue">Total Due:</label>
<input id="txtTotalDue" name="txtTotalDue"  type="number" step="0.01" class="form-control" placeholder="Enter the total amount">

<label for="txtTotalPaid">Total Paid:</label>
<input id="txtTotalPaid" name="txtTotalPaid"  type="number" step="0.01" class="form-control" placeholder="Enter the amount already paid">

<h3>Bill details</h3>

<table class="table">
    <thead>
        <tr>
            <th>Desciption</th>
            <th>Quantity</th>
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
            <td>Insurance certificate</td>
            <td>2</td>
            <td>0.5 $</td>
            <td>0.5 $</td>
        </tr>
        <tr>
            <td>Refund for last month</td>
            <td>1</td>
            <td>-1$</td>
            <td>-1$</td>
        </tr>
        <tr>
            <td colspan="4">
                <a href="#" id="lnkAddBillRow" class="btn btn-info">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add a row to the bill details</a>
            </td>
        </tr>
    </tbody>
</table>


    <br />
    <button type="submit" class="btn btn-success">Create</button>
</form>
</div>

<link href="<?php echo base_url();?>assets/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //Init date picker
        $('.datepicker').datepicker();
        
        //Fill with the date of the day
        $('#txtDate').val(moment().format('L'));
    });
</script>
