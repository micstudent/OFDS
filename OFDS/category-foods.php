<?php include('partial/menu.php'); ?>

<?php
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT title from category WHERE id=$id";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        $title = $row['title'];

    }
    else
    {
        header('location:'.SITEURL);
    }

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                
                $sql2 = "SELECT * FROM food WHERE category_id=$id";
                $query2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($query2);

                if($count2>0)
                {
                    while($row=mysqli_fetch_assoc($query2))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $description = $row['description'];
                                $image_name = $row['image_name'];

                            ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?> MMK</p>
                                        <p class="food-detail">
                                            <?php echo $description; ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                                    
                                <?php
                            }
                }
                else
                {
                    echo "<div class='text-center'><h2>Nothing Here<h2></div>";
                }

            ?>
            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partial/footer.php'); ?>