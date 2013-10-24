<?php 
include_once 'products-data.php'; ?>
  <div class="col-md-2">
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-product"><span class="glyphicon glyphicon-plus-sign"></span> Add Product</button>

    <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" action="products-data.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Add new product</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="category" class="control-label col-md-4">Category</label>
                  <div class="col-md-8">
                    <select class="form-control" name="category" id="category">
                      <option value="">----</option>
                      <?php
                        foreach ($categories as $category) {
                          echo '<option value="'.$category->cat_id.'">'.$category->cat_name.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="proname" class="control-label col-md-4">Product name</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="proname" id="proname">
                  </div>
                </div>
                <div class="form-group">
                  <label for="proimage" class="control-label col-md-4">Product Image</label>
                  <div class="col-md-5">
                    <input type="file" class="form-control" name="proimage" id="proimage" onchange="PreviewImage();">
                    <p class="help-block">Size more than 300px</p>
                  </div>
                  <div class="col-md-3">
                    <img class="img-thumbnail fade" id="uploadPreview" style="max-width: 100%;" />
                    <script type="text/javascript">
                        function PreviewImage() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("proimage").files[0]);

                            oFReader.onload = function (oFREvent) {
                              var imholder = $("#uploadPreview");
                                imholder.parent().parent().removeClass("has-error");
                                imholder.attr('src',oFREvent.target.result);
                                imholder.addClass("in");
                                var img = new Image();
                                img.src =  imholder.attr('src');
                                if(img.width < 300) {
                                 imholder.parent().parent().addClass("has-error");
                                }
                            };
                        };
                    </script>
              </div>
                </div>
                <div class="form-group">
                  <label for="prodesc" class="control-label col-md-4">Product Description</label>
                  <div class="col-md-8">
                    <textarea type="text" class="form-control" name="prodesc" id="prodesc"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="price" class="control-label col-md-4">Price</label>
                  <div class="col-md-8 input-group">
                    <span class="input-group-addon">&#8377;</span>
                    <input type="number" placeholder="00.00" class="form-control" name="price" id="price" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                  </div>
                </div>
                <div class="form-group">
                  <label for="quantity" class="control-label col-md-4">Quantity</label>
                  <div class="col-md-8">
                    <input type="number" placeholder="0" class="form-control" name="quantity" id="quantity">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div><!-- /col-md-2 -->
  <div class="col-md-10">
    <?php
    if(isset($products) && count($products)>0)
    {
    ?>
    <table class="table table-hover products-table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Image</th>
          <th>Product Description</th>
          <th>Category</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($products as $product) {
        ?>
          <tr>
            <td><?php echo $product->pd_name ?></td>
            <td><img src="../img/uploads/<?php echo $product->pd_image ?>" alt="<?php echo $product->pd_name ?>" style="max-width:140px;"></td>
            <td><?php echo $product->pd_description ?></td>
            <td><?php echo $product->cat_name ?></td>
            <td class="text-center">&#8377; <?php echo $product->pd_price ?></td>
            <td class="text-center"><?php echo $product->pd_qty ?></td>
            <td class="text-center"><a href="products-data.php?delete=<?php echo $product->pd_id ?>"><span class="glyphicon glyphicon-trash"> </span></a></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    }
    else { ?>
      <div class="alert alert-warning"><strong>Oh my!</strong> Didn't find any products, please add some.</div>
    <?php
    }
    ?>
  </div><!-- /col-md-10 -->