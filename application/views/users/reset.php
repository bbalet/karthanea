<?php
/**
 * This view contains a form that helps to reset the password of the user
 * @copyright  Copyright (c) 2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */

$attributes = array('id' => 'target', 'class' => 'form-inline');
echo form_open('users/reset/' . $target_user_id, $attributes); ?>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" required /><br />
    </div>
    <button id="send" class="btn btn-warning">Reset</button>
</form>
<script type="text/javascript">
    $(function () {
        //Validate the form if the user press enter key in password field
        $('#password').keypress(function(e){
            if(e.keyCode==13)
            $('#send').click();
        });
    });
</script>
