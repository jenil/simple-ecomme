<?php
//Start session
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
	<div class="container-rock">
      <div id="carousel-example-generic" class="carousel slide">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="img/gallery_perform.png" alt="...">
            <div class="carousel-caption">
              <h4>The new MacBook Air</h4>
              All the power blah blah..
            </div>
          </div>
          <div class="item" style="">
            <img src="img/gallery_software.png" alt="...">
            <div class="carousel-caption">Hold it 2!
            </div>
          </div>
          <div class="item" style="">
            <img src="img/gallery_perform.png" alt="...">
            <div class="carousel-caption">Hold it 3!
            </div>
          </div>
        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">        <span class="icon-prev"></span>      </a><a class="right carousel-control" href="#carousel-example-generic" data-slide="next">        <span class="icon-next"></span>      </a>
      </div>
    </div>
    <hr />
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-xs-6 text-center">
        	<a href="store.php?category=1"><img src="img/home-shopmac.png" alt="Shop Mac"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
        	<a href="store.php?category=11"><img src="img/home-shopiphone.png" alt="Shop iPhone"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
        	<a href="store.php?category=7"><img src="img/home-shopipad.png" alt="Shop iPad"></a>
        </div>
        <div class="col-sm-3 col-xs-6 text-center">
        	<a href="store.php?category=1"><img src="img/home-shopipod.png" alt="Shop iPod"></a>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>