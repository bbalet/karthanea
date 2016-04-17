<?php 
/**
 * This view displays a login form
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>
<div class="container-fluid" id="wrap">

    <div class="row vertical-center">
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4 form-box">

<h2>Login</h2>

<?php echo $flash_partial_view;?>

<?php echo validation_errors(); ?>

<?php
$attributes = array('id' => 'loginFrom', 'class' => 'form-horizontal');
echo form_open('connection/login', $attributes);?>

    <input type="hidden" name="last_page" value="connection/login" />
    <label for="login">login</label>
    <input type="text" class="form-control" name="login" id="login" value="<?php echo set_value('login'); ?>" autofocus required /><br />
    <label for="password">password</label>
    <input type="password" class="form-control" name="password" id="password" /><br />
    <button id="send" class="btn btn-primary"><span class="glyphicon  glyphicon-user glyphicon-white"></span>&nbsp;Login</button><br />
    <br />
    <a href="#" id="cmdForgetPassword" class="btn btn-info"><span class="glyphicon glyphicon-envelope glyphicon-white"></span>&nbsp;Send me my password</a>
</form>
    
        </div>
        <div class="col-md-4">&nbsp;</div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
    $(function () {        
        //If the user has forgotten his password, send an e-mail
        $('#cmdForgetPassword').click(function() {
            if ($('#login').val() == "") {
                bootbox.alert("Please fill the login field");
            } else {
                $.ajax({
                   type: "POST",
                   url: "<?php echo base_url(); ?>connection/forgetpassword",
                   data: { login: $('#login').val() }
                 })
                 .done(function(msg) {
                   switch(msg) {
                       case "OK":
                           bootbox.alert("The password has been sent to your e-mail adress.");
                           break;
                       case "UNKNOWN":
                           bootbox.alert("Invalid login id or password");
                           break;
                   }
                 });
            }
        });
        
        //Validate the form if the user press enter key in password field
        $('#password').keypress(function(e){
            if(e.keyCode==13)
            $('#loginFrom').submit();
        });
    });
</script>
