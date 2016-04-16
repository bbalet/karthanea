<?php 
/**
 * This view displays a client creation form
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<h1>Create a new client</h1>

<form action="<?php echo base_url();?>clients/search" method="POST">
  <div class="form-group">
    <label for="firstname">First name</label>
    <input type="text" class="form-control" name="firstname" placeholder="First name">
  </div>
  <div class="form-group">
    <label for="lastname">Last name</label>
    <input type="text" class="form-control" name="lastname" placeholder="Last name">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Email">
  </div>


  <button type="submit" class="btn btn-default">Create</button>
</form>

</div>
