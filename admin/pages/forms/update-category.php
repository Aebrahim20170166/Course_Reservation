<?php
    //session_start();
    include 'Assets/navbar.php';

    include '../../../backend/categories.php';
    
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $categoryData=Category::getCategoryData($id);
  }
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form method="post" action="../../../backend/categories.php">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $categoryData['name'];?>" class="form-control" id="name" >
                    <input type="hidden" name="id" value="<?php echo $categoryData['id'];?>">
                    <input type="hidden" name="script" value="">
                </div>

              <div class="card-footer">
                <button type="submit" name="submit_update" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>


      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include 'Assets/footer.php';
?>