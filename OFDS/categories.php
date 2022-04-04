<?php include('partial/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                        $sql = "SELECT * FROM category WHERE active='Yes'";
        
                        $query = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($query);

                        $sn =1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($query))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];

                            ?>
                                <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
                                    <div class="box-3 float-container">
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>
                                    
                                <?php
                            }
                        }
                        else{
                            echo "<div class='error'>Category not found.</div>";
                        }
                ?>
        
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partial/footer.php'); ?>