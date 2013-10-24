<?php
include_once 'category-data.php'; ?>
  <div class="col-md-2">
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-category"><span class="glyphicon glyphicon-plus-sign"></span> Add Category</button>

    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" action="category-data.php" method="POST">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Add new category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="catname" class="control-label col-md-4">Category name</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="catname" id="catname">
                  </div>
                </div>
                <div class="form-group">
                  <label for="catdesc" class="control-label col-md-4">Category description</label>
                  <div class="col-md-8">
                    <textarea type="text" class="form-control" name="catdesc" id="catdesc"></textarea>
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
    if(isset($categories) && count($categories)>0)
    {
    ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Category Description</th>
          <th class="text-center">Products</th>
          <th class="text-center">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($categories as $category) {
        ?>
          <tr>
            <td><?php echo $category->cat_name ?></td>
            <td><?php echo $category->cat_description ?></td>
            <td class="text-center"><?php echo $category->product_count ?></td>
            <td class="text-center"><a href="category-data.php?delete=<?php echo $category->cat_id ?>"><span class="glyphicon glyphicon-trash"> </span></a></td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <?php
    }
    else { ?>
      <div class="alert alert-warning"><strong>Oh my!</strong> Didn't find any categories, please add some.</div>
    <?php
    }
    ?>
  </div><!-- /col-md-10 -->