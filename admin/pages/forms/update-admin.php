<?php
    session_start();
    include 'Assets/navbar.php';
    include '../../../backend/admins.php';
    $id=$_GET['id'];
    $admin=Admin::getAdmin($id);
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
              <h3 class="card-title">update Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="../../../backend/admins.php">
              <div class="card-body">
                <div class="form-group">
                  <label for="location">Admin Name</label>
                  <input type="text" name="name" class="form-control" id="location" value="<?php echo $admin['name'];?>">
                </div>

                <div class="form-group">
                  <label for="phone">Admin Email</label>
                  <input type="text" name="email" class="form-control" id="phone" value="<?php echo $admin['email'];?>">
                </div>

                  <div class="form-group">
                      <label for="email">Admin Password</label>
                      <input type="password" name="password" class="form-control" id="email" >
                  </div>
                  <input type="hidden" name="id" value="<?php echo $admin['id'];?>">

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