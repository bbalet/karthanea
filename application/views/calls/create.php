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

Input to search for a client -> button select

Date of Call => read only input

Call center operator => input

<textarea name="editor" id="editor" rows="10" cols="80">
    This is my textarea to be replaced with CKEditor.
</textarea>


</div>

<link href="<?php echo base_url();?>assets/ckeditor/contents.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	CKEDITOR.replace( 'editor' );
});
</script>
