<?php
    include 'Assets/navbar.php';
    include '../../../backend/aboutus.php';
    
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $aboutData=aboutUS::getAbouData($id);
  }
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update About US</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/aboutus.php">
              <div class="card-body">
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" name="location" class="form-control" id="location" value="<?php echo $aboutData['location'];?>">
                </div>

                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" id="phone" value="<?php echo $aboutData['phone'];?>">
                </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" name="email" class="form-control" id="email" value="<?php echo $aboutData['email'];?>">
                  </div>
                   <input type="hidden" name="id" value="<?php echo $aboutData['id'];?>">
                   <input type="hidden" name="script" value="">
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