<?php
session_start();
    include 'Assets/navbar.php';
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
              <h3 class="card-title">Add Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/admins.php">
              <div class="card-body">
                <div class="form-group">
                  <label for="location">Admin Name</label>
                  <input type="text" name="name" class="form-control" id="location" placeholder="Enter Your Name">
                </div>

                <div class="form-group">
                  <label for="phone">Admin Email</label>
                  <input type="text" name="email" class="form-control" id="phone" placeholder="Enter Your Email">
                </div>

                  <div class="form-group">
                      <label for="email">Admin Password</label>
                      <input type="password" name="password" class="form-control" id="email" placeholder="Enter Your password">
                  </div>
                
                  <div class="form-group">
                      <label for="email">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="email" placeholder="Enter Your password">
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