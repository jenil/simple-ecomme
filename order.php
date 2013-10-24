<?php
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
  <header class="container">
    <h3 class="page-header">Order</h3>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-6">
        <?php if( count($_SESSION['CART']) > 0 )  { ?>
        <h4>Review Order Items</h4>
    	<div class="table-responsive">
    		<table class="table products-table">
		      <thead>
		        <tr>
		          <th>Preview</th>
		          <th>Name</th>
		          <th class="text-center">Price</th>
		          <th class="text-center">Remove</th>
		        </tr>
		      </thead>
		      <tbody>
		        <?php
            $_SESSION['total'] = 0;
		        foreach ($_SESSION['CART'] as $item) {
              $_SESSION['total'] += $item['pd_price'];
		          ?>
		          <tr>
		            <td><img style="max-width:140px;" src="img/uploads/<?php echo $item['pd_image'] ?>" alt="<?php echo $item['pd_name'] ?>"></td>
		            <td><?php echo $item['pd_name'] ?></td>
                <?php setlocale(LC_MONETARY,'en_US'); ?>
		            <td class="text-center">&#8377; <?php echo money_format('%!i', floatval($item['pd_price'])); ?></td>
		            <td class="text-center"><a href="cart.php?del=<?php echo $item['pd_id'] ?>"><span class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure you want to delete this item from you cart?');"> </span></a></td>
		          </tr>
		          <?php
		        }
		        ?>
            <tr>
              <td>&nbsp;</td>
              <td>
                <h4>Total:</h4>
              </td>
              <td class="text-info text-center">
                &#8377; <?php echo money_format('%!i', floatval($_SESSION['total'])); ?>
              </td>
              <td>&nbsp;</td>
            </tr>
		      </tbody>
		    </table>
    	</div>
	    <?php 
	    } // check count of cart
	    else
	    {
	      echo '<div class="alert alert-info">Oh no! Add something to your cart from the Store.</div>';
	    }
	    ?>
      </div>
      <div class="col-md-5 col-sm-6">
        <h4>Order Details</h4>
        <form id="oform" class="form-horizontal" action="includes/order-exec.php" method="POST">
          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Steve Jobs" name="name" id="name">
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-4 control-label">Address</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="address" id="address"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="city" class="col-sm-4 control-label">City</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Mumbai" name="city" id="city">
            </div>
          </div>
          <div class="form-group">
            <label for="postal_code" class="col-sm-4 control-label">PIN Code</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="400001" name="postal_code" id="postal_code">
            </div>
          </div>
          <button class="btn btn-block btn-success btn-lg">Order &amp; Checkout<br></button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    $('#oform').submit(function(e){
      $('.alert-warning').remove();
      var name = $('#name').val();
      var address = $('#address').val();
      var city = $('#city').val();
      var postal_code = $('#postal_code').val();
      if(name == '' || address == '' || city=='' || postal_code=='' )
      {
        $('<div class="alert alert-warning"><b>Oh no!</b> Please fill all feilds.</div>').hide().insertBefore('#oform');
        $('.alert-warning').fadeIn();
        return false;
      }
      else
      {
        return true;
      }
    });
</script>
<?php
include 'includes/footer.php';
?>