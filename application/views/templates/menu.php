    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">Karthanea</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

<?php /*
//User Management only if connected user is an admin of the system
            <?php if ($is_admin == TRUE) { ?>
            <ul class="nav navbar-nav">			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_admin_title');?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>users"><?php echo lang('menu_admin_list_users');?></a></li>
                  <li><a href="<?php echo base_url();?>users/create"><?php echo lang('menu_admin_add_user');?></a></li>
                </ul>
              </li>
            </ul>
            <?php } */?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>clients/search">Search</a></li>
                <li><a href="<?php echo base_url();?>clients/create">Create</a></li>
              </ul>
            </li>

<?php
//Call Center Management
?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Call Center <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>calls/create">Create Call</a></li>
                <li><a href="<?php echo base_url();?>calls/search">Search for a call</a></li>
                <li><a href="<?php echo base_url();?>calls/unlinked">Calls not linked to client</a></li>
              </ul>
            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-right" action="<?php echo base_url();?>clients/search/any">
            <div class="form-group">
              <input type="text" name="criterion" placeholder="Search client/contract" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
            <a href="#" class="btn btn-success" title="Reset password" id="cmdChangeMyPwd"><span class="glyphicon glyphicon-lock"></span></a>
            <a href="<?php echo base_url();?>connection/logout" class="btn btn-warning" title="Logout"><span class="glyphicon glyphicon-off"></span></a>
          </form>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


<div class="modal hide" id="frmModalAjaxWaitPwd" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
            <h1>Please wait</h1>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url();?>assets/images/loading.gif"  align="middle">
        </div>
 </div>

<div id="frmChangeMyPwd" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Reset password</h4>
        </div>
        <div id="frmChangeMyPwdBody" class="modal-body"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function () {
        $('#cmdChangeMyPwd').click(function() {
            $('#frmModalAjaxWaitPwd').modal('show');
            $("#frmChangeMyPwdBody").load('<?php echo base_url();?>users/reset/<?php echo $this->session->userdata('id'); ?>', function(){
                $('#frmModalAjaxWaitPwd').modal('hide');
                $('#frmChangeMyPwd').modal('show'); 
            });
        });
        $('#frmChangeMyPwd').on('hidden', function() {
            $(this).removeData('modal');
        });
});
</script>
