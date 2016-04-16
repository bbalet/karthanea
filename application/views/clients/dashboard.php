<?php
/**
 * This view displays the client dashboard.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Dashboard of client <span class="text-muted">Georges DURAND</span></h1>

<p>Links to client's bills and contracts:</p>

<ul>
	<li><a href="<?php echo base_url();?>clients/22/bills">Link to bills.</a></li>
	<li><a href="<?php echo base_url();?>clients/22/contracts">Link to contracts.</a></li>
</ul>

<p>https://www.jstree.com/ allows us to represent the list above with a treeview.</p>

<div class="row">
  <div class="col-md-6">
  	<div id="clientTree"></div>
  </div>
  <div class="col-md-6">
  	<h3>Details</h3>
	  <div id="infoPane">
	  	Click a node
	  </div>
  </div>
</div>


</div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/jstree/themes/default/style.min.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/jstree/jstree.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#clientTree').jstree({
	  "core" : {
	    "animation" : 0,
	    "check_callback" : true,
	    "themes" : { "stripes" : true },
	    'data' : {
	      'url' :  '<?php echo base_url();?>clients/<?php echo 1;?>/dashboardTree'
	    }
	  },
	  "types" : {
	    "#" : {
	      "max_children" : 1,
	      "max_depth" : 4,
	      "valid_children" : ["root"]
	    },
	    "root" : {
	      "icon" : "glyphicon glyphicon-file",
	      "valid_children" : ["default"]
	    },
	    "default" : {
	      "valid_children" : ["default","file"]
	    },
	    "file" : {
	      "icon" : "glyphicon glyphicon-file",
	      "valid_children" : []
	    }
	  },
	  "plugins" : [
	    "search", "state", "types"
	  ]
	});

	$("#clientTree").bind(
	        "select_node.jstree", function(evt, data){
	            value = '<p>selected node object: ' + data.node.id + '</p>';
	            value += '<p>selected node text: ' + data.node.text + '</p>';
	            $("#infoPane").html(value);
	        }
	);

});
</script>
