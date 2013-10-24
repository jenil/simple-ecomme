<body>
  <div class="wrap">
    <nav>
      <div class="navbar navbar-fixed-top navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a href="index.php" class="navbar-brand">iDukan</a>           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          </div>
          <div class="collapse navbar-collapse" role="navigation" id="navbar-main">
            <ul class="nav navbar-nav">
              <li <?php echo strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 ? 'class="active"' : ''; ?>>
                <a href="index.php">Home</a>              </li>
              <li <?php echo strpos($_SERVER['REQUEST_URI'], 'store.php') > 0 ? 'class="active"' : ''; ?>>
                <a href="store.php">Store</a>              </li>
              <li <?php echo strpos($_SERVER['REQUEST_URI'], 'contact.php') > 0 ? 'class="active"' : ''; ?>>
                <a href="contact.php">Contact</a>              </li>
            </ul>
            <form class="navbar-form navbar-left" action="store.php" method="GET">
              <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="label label-info"><?php echo isset($_SESSION['CART']) ? count($_SESSION['CART']) : 0; ?></span></a>
              </li>
              <li>
                <?php if(isset($_SESSION['SESS_USER_ID'])) { ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $_SESSION['SESS_USERNAME'] ?>! <b class="caret"></b></a>
                    <ul class="dropdown-menu" style="">
                      <?php if(intval($_SESSION['SESS_IS_ADMIN']) === 1) { ?>
                        <li>
                          <a href="admin/">Administration</a>
                        </li>
                      <?php } ?>
                      <li <?php echo strpos($_SERVER['REQUEST_URI'], 'store.php') > 0 ? 'class="active"' : ''; ?>>
                        <a href="profile.php">Profile</a>
                      </li>
                      <li>
                        <a href="logout.php">Logout</a>
                      </li>
                    </ul>
                  </li>
                <?php } else { ?>
                <a href="login.php">Login</a>
                <?php } ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="container" id="messages">
      <?php
          if( isset($_SESSION['MSGS']) && is_array($_SESSION['MSGS']) && count($_SESSION['MSGS']) >0 ) {
              ?>
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul class="list-unstyled">
                  <?php 
                  foreach ($_SESSION['MSGS'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                  ?>
                </ul>
              </div>
            <?php
            unset($_SESSION['MSGS']);
          }
        ?>
        <?php
          if( isset($_SESSION['ERR_MSGS']) && is_array($_SESSION['ERR_MSGS']) && count($_SESSION['ERR_MSGS']) >0 ) {
              ?>
              <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul class="list-unstyled">
                  <?php 
                  foreach ($_SESSION['ERR_MSGS'] as $msg) {
                    echo '<li>'.$msg.'</li>';
                  }
                  ?>
                </ul>
              </div>
            <?php
            unset($_SESSION['ERR_MSGS']);
          }
        ?>
    </div>