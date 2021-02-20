<?php
    include 'Assets/navbar.php';
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add About US</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/aboutus.php">
              <div class="card-body">
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" name="location" class="form-control" id="location" placeholder="Enter Location">
                </div>

                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" id="phone" placeholder="Enter Phone Number">
                </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                  </div>

              <div class="card-footer">
                <button type="submit" name="add_submit" class="btn btn-primary">Add</button>
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