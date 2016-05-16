<?php 
/**
 * This view allows to edit a Contract
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Edit Contract <span class="text-muted">1245XY12</span></h1>

<form action="<?php echo base_url();?>contracts/edit" method="POST">

<p>Client: <a target="_blank" href="<?php echo base_url();?>clients/22/dashboard">Georges DURAND</a></p>

<label for="txtRef">Ref:</label>
<input id="txtRef" name="txtRef" type="text" class="form-control" value="1245XY12">

<label for="txtDate">Date : </label>
<input name="txtDate" type="text" class="form-control datepicker" value="03/25/2016" readonly="readonly">

<label for="cboStatus">Status:</label>
<select id="cboStatus" name="cboStatus" class="form-control">
    <option selected>Opened</option>
    <option>Closed</option>
    <option>Cancelled</option>
    <option>Pending signature</option>
    <option>Pending Analysis</option>
    <option>Proposal</option>
</select>

<label for="cboType">Type:</label>
<select id="cboType" name="cboType" class="form-control">
    <option selected>Car</option>
    <option>Moto</option>
    <option>House</option>
    <option>Flat</option>
    <option>Life</option>
</select>

<label for="editor">Terms</label>
<textarea name="editor" id="editor" rows="10" cols="80">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend nisi et tellus varius, nec commodo sapien viverra. Curabitur ut dolor vitae lorem dignissim varius. Integer posuere ante in massa scelerisque posuere. Mauris sollicitudin diam et lectus iaculis cursus. Aliquam dignissim laoreet volutpat. Mauris vestibulum quam vel nibh ultricies luctus. Etiam eget sollicitudin lectus. Nulla placerat ante et efficitur aliquam. Suspendisse potenti. Vivamus ultrices fringilla enim, non efficitur justo tristique nec. Donec eleifend ut ex eget vehicula. Fusce tempus nunc in nulla dictum, nec bibendum erat hendrerit. In eget ligula volutpat, lobortis tortor in, maximus lacus. Etiam id velit sit amet dolor tincidunt tincidunt auctor a urna. Mauris bibendum metus risus, vitae blandit purus elementum ac.

Morbi tincidunt, sapien sit amet pharetra blandit, lacus turpis vestibulum risus, id aliquam quam tortor vel urna. Nulla auctor faucibus volutpat. Proin accumsan ex id tortor euismod, molestie efficitur tellus congue. Donec eget enim ullamcorper, pulvinar purus sit amet, luctus tellus. Suspendisse condimentum mi vel dapibus sodales. Sed nec sem tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ultricies eu mi at sodales. Etiam ut mi ligula. Pellentesque a felis sed nunc pellentesque cursus id eget justo. Suspendisse vel ex id elit convallis eleifend non in nibh. Ut porttitor est sit amet enim fringilla ullamcorper. Fusce laoreet risus sit amet efficitur bibendum. Nam sollicitudin tincidunt vestibulum. Phasellus vehicula ligula augue, ut ornare odio sodales a.

Nunc vel tristique leo. Sed iaculis fringilla diam nec iaculis. Phasellus diam nulla, lobortis nec vehicula a, pharetra eu enim. Nullam efficitur dolor vitae justo dignissim, quis auctor arcu pulvinar. Integer vulputate vel lacus id fringilla. Sed eu est non neque placerat dapibus eu eu ante. Maecenas mi lorem, aliquet ac ex in, sagittis condimentum massa. Aenean mollis mi a sagittis maximus. Aenean viverra nibh nec metus blandit lobortis vel vel felis. Nam consectetur sapien ante, in maximus nisl suscipit id. Nunc quis purus nulla. Aliquam id arcu placerat, tempor neque a, ultricies lacus. Aenean in nisl elit. Etiam ac metus dignissim, fermentum nunc vitae, malesuada felis.

Quisque eu ex a velit vehicula placerat. Sed congue turpis ut turpis maximus auctor. In scelerisque risus mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur et nunc pulvinar, aliquam velit et, iaculis arcu. Suspendisse congue efficitur sapien vitae scelerisque. Aenean ac lorem aliquet, vestibulum magna nec, convallis metus. Nulla at diam vitae felis finibus lobortis ac et turpis. In ultrices nibh magna, ut fermentum nisi tristique nec. Nunc elit ex, eleifend eget lacinia id, tempor ut mi. Nulla ut dolor lacinia, sollicitudin mauris quis, consequat massa. Sed fermentum vulputate nisi et luctus. Sed nec tortor sed diam elementum posuere. Ut iaculis faucibus quam.

Donec ac sem vitae nunc molestie iaculis nec eu tellus. Cras ullamcorper elit justo, nec auctor sem sollicitudin sed. Nullam fringilla quam a ipsum dapibus cursus. Nunc tellus diam, lobortis eu volutpat vel, congue at nibh. Suspendisse facilisis dui lacus, quis dignissim nisi varius scelerisque. Sed laoreet interdum dui eget gravida. Praesent non porta risus. Mauris vitae mollis sapien, nec tempus mi. Vestibulum mollis, erat sed molestie condimentum, libero quam semper dolor, pretium ultrices massa orci vel ipsum. Pellentesque in dolor nec magna mattis dictum at nec velit. Aliquam tellus purus, rutrum bibendum justo eu, placerat vulputate urna. Sed porta justo a metus blandit venenatis. Nullam vitae rhoncus neque. Nunc sed dignissim urna.
</textarea>

    <br />
  <button type="submit" class="btn btn-success">Save</button>
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
