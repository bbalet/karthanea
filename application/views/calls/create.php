<?php 
/**
 * This view allows to create a new Call
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Create a new Call</h1>

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
<input name="txtDuration" id="txtDuration" type="text" class="form-control" readonly="readonly">

<label for="editor">Details about the call</label>
<textarea name="editor" id="editor" rows="10" cols="80">
    This is my textarea to be replaced with CKEditor.
</textarea>

<br />

  <button type="submit" class="btn btn-success">Create</button>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/extensions/Select/js/dataTables.select.min.js"></script>

<script type="text/javascript">
var	clsStopwatch = function() {
        // Private vars
        var	startAt	= 0;	// Time of last start / resume. (0 if not running)
        var	lapTime	= 0;	// Time on the clock when last stopped in milliseconds

        var	now	= function() {
                        return (new Date()).getTime(); 
                }; 

        // Public methods
        // Start or resume
        this.start = function() {
                        startAt	= startAt ? startAt : now();
                };

        // Stop or pause
        this.stop = function() {
                        // If running, update elapsed time otherwise keep it
                        lapTime	= startAt ? lapTime + now() - startAt : lapTime;
                        startAt	= 0; // Paused
                };

        // Reset
        this.reset = function() {
                        lapTime = startAt = 0;
                };

        // Duration
        this.time = function() {
                        return lapTime + (startAt ? now() - startAt : 0); 
                };
};

var x = new clsStopwatch();
var clocktimer;

function pad(num, size) {
        var s = "0000" + num;
        return s.substr(s.length - size);
}

function formatTime(time) {
        var h = m = s = ms = 0;
        var newTime = '';

        h = Math.floor( time / (60 * 60 * 1000) );
        time = time % (60 * 60 * 1000);
        m = Math.floor( time / (60 * 1000) );
        time = time % (60 * 1000);
        s = Math.floor( time / 1000 );
        ms = time % 1000;

        newTime = pad(h, 2) + ':' + pad(m, 2) + ':' + pad(s, 2) + ':' + pad(ms, 3);
        return newTime;
}

function update() {
        $("#txtDuration").val(formatTime(x.time()));
}

function start() {
        clocktimer = setInterval("update()", 1);
        x.start();
}

function stop() {
        x.stop();
        clearInterval(clocktimer);
}

$(document).ready(function() {
        //Create editor
        CKEDITOR.replace( 'editor' );
        //Start stopwatch
        start();

        //On click select client, show the modal form
    $('#cmdSelectClient').click(function() {
        $('#frmSelectClient').modal('show');
        //Transform the HTML table
        $('#clients').dataTable({
            select: true
        });
    });
});

</script>
