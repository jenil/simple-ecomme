<?php
	session_start();

  include 'includes/header.php';
  include 'includes/nav.php';
?>
<div class="container">
      <div class="row">
        <div class="col-xs-offset-4 col-sm-4 col-sm-offset-4">
          <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
              ?>
              <div class="alert alert-warning">
                <ul class="list-unstyled">
                  <?php 
                  foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                  ?>
                </ul>
              </div>
            <?php
            unset($_SESSION['ERRMSG_ARR']);
          }
        ?>
          <form action="includes/register-exec.php" method="post">
            <h3>Register Here</h3>
            <div class="form-group">
              <label class="control-label">Username<br></label>
              <div class="controls">
                <input type="text" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" class="form-control" placeholder="mogambo" name="username" maxlength="20">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Email</label>
              <div class="controls">
                <input type="email" class="form-control" placeholder="mogambo@india.com" name="email" maxlength="30">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <div class="controls">
                <input type="password" class="form-control" placeholder="Greater than 6 characters" name="password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <div class="controls">
                <input type="password" class="form-control" placeholder="Confirm password" name="cpassword">
              </div>
            </div>
            <button class="btn btn-block btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
<?php 
include 'includes/footer.php';
?>
