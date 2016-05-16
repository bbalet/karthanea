<?php 
/**
 * This view allows to create a new Contract
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Create a new Contract</h1>

<form action="<?php echo base_url();?>contracts/create" method="POST">

<p>Client: <a target="_blank" href="<?php echo base_url();?>clients/22/dashboard">Georges DURAND</a></p>

<label for="txtRef">Ref:</label>
<input id="txtRef" name="txtRef" type="text" class="form-control" placeholder="Enter a reference">

<label for="txtDate">Date : </label>
<input name="txtDate" type="text" class="form-control datepicker" placeholder="Select a date" readonly="readonly">

<label for="cboStatus">Status:</label>
<select id="cboStatus" name="cboStatus" class="form-control">
    <option>Opened</option>
    <option>Closed</option>
    <option>Cancelled</option>
    <option>Pending signature</option>
    <option>Pending Analysis</option>
    <option>Proposal</option>
</select>

<label for="cboType">Type:</label>
<select id="cboType" name="cboType" class="form-control">
    <option>Car</option>
    <option>Moto</option>
    <option>House</option>
    <option>Flat</option>
    <option>Life</option>
</select>

<label for="editor">Terms</label>
<textarea name="editor" id="editor" rows="10" cols="80">
    This is my textarea to be replaced with CKEditor.
</textarea>

    <br />
  <button type="submit" class="btn btn-success">Create</button>
</form>

</div>

<link href="<?php echo base_url();?>assets/ckeditor/contents.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url();?>assets/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //Init date picker
        $('.datepicker').datepicker();

        //Create editor
        CKEDITOR.replace( 'editor' );

    });
</script>
