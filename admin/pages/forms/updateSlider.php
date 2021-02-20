<?php
session_start();
include 'Assets/navbar.php';
include '../../../backend/sliders.php';

if(isset($_GET['id'])){
$id = $_GET['id'];
$sliderData=Sliders::getSliderData($id);
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
        <?php
        if(!empty($_SESSION['success']))
        {
          ?>
        <div class="alert alert-success" role="alert">
        <?php
         echo $_SESSION['success'];
         ?>
         </div>
         <?php
         session_unset();
        }
        if(!empty($_SESSION['error']))
        {
          ?>
        <div class="alert alert-danger" role="alert">
        <?php
         echo $_SESSION['error'];
         ?>
         </div>
         <?php
         session_unset();
        }
        ?>
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/sliders.php" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                    <input type="hidden" name="slider_id" value="<?php echo $sliderData['id'];?>">
                    <input type="hidden" name="old_image" value="<?php echo $sliderData['image_name'];?>">
                    <input type="hidden" name="script" value="">
                  </div>
                </div>

              <div class="card-footer">
                <button type="submit" name="update_submit" class="btn btn-primary">Update</button>
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