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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>clients/search">Search</a></li>
                <li><a href="<?php echo base_url();?>clients/create">Create</a></li>
              </ul>
            </li>
            */
            ?>

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
                <li><a href="<?php echo base_url();?>calls/unlink">Calls not linked to client</a></li>
              </ul>
            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-right" action="<?php echo base_url();?>clients/search/any">
            <div class="form-group">
              <input type="text" name="criterion" placeholder="Search client/contract" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
          </form>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
