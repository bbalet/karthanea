<?php
/**
 * This view contains a form to create a new user
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<div class="row-fluid">
    <div class="col-md-12">

<h1>Create a new user</h1>

<?php echo validation_errors(); ?>

<?php
$attributes = array('id' => 'target', 'class' => 'form-horizontal');
echo form_open('users/create', $attributes); ?>
    
       <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">firstname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="firstname" id="firstname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">lastname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lastname" id="lastname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">login</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="login" id="login" required />
                <div class="alert alert-info" role="alert" id="lblLoginAlert">
                    <button type="button" class="close" onclick="$('#lblLoginAlert').hide();">&times;</button>
                    This username is not available.
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="role[]" class="col-sm-2 control-label">role</label>
            <div class="col-sm-10">
                <select class="form-control" name="role[]" multiple="multiple" size="2" required>
                <?php foreach ($roles as $roles_item): ?>
                    <option value="<?php echo $roles_item['id'] ?>" <?php if ($roles_item['id'] == 2) echo "selected" ?>><?php echo $roles_item['name'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">password</label>
            <div class="col-sm-8">
                    <input class="form-control" type="password" name="password" id="password" required />
            </div>
            <div class="col-sm-2">
                    <a class="btn btn-default" id="cmdGeneratePassword">
                        <span class="glyphicon glyphicon-refresh"></span>&nbsp;Generate password
                    </a>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="send" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Create</button>
                &nbsp;
                <a href="<?php echo base_url(); ?>users" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
             </div>
        </div>
    </form>
    </div>
</div>

</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">

    function validate_form() {
        result = false;
        var fieldname = "";
        if ($('#firstname').val() == "") fieldname = "firstname";
        if ($('#lastname').val() == "") fieldname = "lastname";
        if ($('#login').val() == "") fieldname = "login";
        if ($('#email').val() == "") fieldname = "email";
        if ($('#password').val() == "") fieldname = "password";
        if (fieldname == "") {
            return true;
        } else {
            bootbox.alert("The field " + fieldname + " is mandatory.");
            return false;
        }
    }
    
/**
 * Generate a password of the specified length
 * @param int len   length of password to be generated
 * @returns string  generated password
 */
function password_generator(len) {
    var length = (len)?(len):(10);
    var string = "abcdefghijklnopqrstuvwxyz";
    var numeric = '0123456789';
    var punctuation = '!?=';
    var password = "";
    var character = "";
    while(password.length < length) {
        entity1 = Math.ceil(string.length * Math.random() * Math.random());
        entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
        entity3 = Math.ceil(punctuation.length * Math.random() * Math.random());
        hold = string.charAt(entity1);
        hold = (entity1 % 2 == 0)?(hold.toUpperCase()):(hold);
        character += hold;
        character += numeric.charAt( entity2 );
        character += punctuation.charAt( entity3 );
        password = character;
    }
    return password;
}
    
    $(function () {
        $("#lblLoginAlert").hide();
        
        $("#cmdGeneratePassword").click(function() {
            $("#password").val(password_generator(<?php echo $this->config->item('password_length');?>));
        });
        
        //On any change on firstname or lastname fields, automatically build the
        //login identifier with first character of firstname and lastname
        $("#firstname").change(function() {
            $("#login").val($("#firstname").val().charAt(0).toLowerCase() +
                $("#lastname").val().toLowerCase());            
        });
        $("#lastname").change(function() {
            $("#lastname").val($("#lastname").val().toUpperCase());
            $("#login").val($("#firstname").val().charAt(0).toLowerCase() +
                $("#lastname").val().toLowerCase());            
        });
        
        //Check if the username already exists
        $("#login").change(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>users/check/login",
                data: { login: $("#login").val() }
                })
                .done(function( msg ) {
                    if (msg == "true") {
                        $("#lblLoginAlert").hide();
                    } else {
                        $("#lblLoginAlert").show();
                    }
                });
        });
        
        $('#send').click(function() {
            if (validate_form() == false) {
                //Error of validation
            } else {
                $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>users/check/login",
                data: { login: $("#login").val() }
                })
                .done(function( msg ) {
                    if (msg == "true") {
                        $("#target").submit();
                    } else {
                        bootbox.alert("Username already exists.");
                    }
                });
            }
        });
    });
</script>
