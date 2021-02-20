
<?php
    include 'Assets/navbar.php';
?>

<!-- Start Slider Section -->

<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        include "backend/sliders.php";
        $sliders=Sliders::getSliders();
        $path="admin/pages/upload/";
        $counter=1;
        while($row=$sliders->fetch())
        {
            if($counter==1)
            {
                $counter+=1;
        ?>
        <div class="carousel-item active">
            <img src="<?php echo $path.$row['image'];?>" class="d-block w-100" alt="..." height="500px">
        </div>

        <?php
        }
            else{
                ?>
        <div class="carousel-item">
            <img src="<?php echo $path.$row['image'];?>" class="d-block w-100" alt="..." height="500px">
        </div>
        <?php
            }
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- End Slider Section -->

<!-- Start New Courses -->
<div class="new-courses">
    <div class="container">
        <h3> New Courses </h3><br>

        <div class="row">
            <?php
            include "backend/UserHome.php";
            $newCourses=UserHome::getNewCourses();
            while($row2=$newCourses->fetch())
            {
            ?>
            <div class="course col-md-4">
                <div class="card" style="width: 18rem;">

                    <img src="<?php echo $path.$row2['image_name'];?>" class="card-img-top" alt="image" height="150px">

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row2['title']; ?></h5>
                        <p class="card-text">
                            <?php echo substr($row2['body'],0,50); ?>
                        </p>
                    </div>

                    <div class="card-body">
                        <button type="button" class="btn btn-primary">See More</button>
                    </div>

                </div>
            </div>
                <?php
            }
            ?>
        </div>

    </div>

</div>



<?php
include 'Assets/footer.php';
?>

