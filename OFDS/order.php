<?php include('partial/menu.php'); ?>

<?php
    
    if(isset($_GET['food_id']))
    {
        $id = $_GET['food_id'];
        $sql = "SELECT * from food WHERE id=$id";
        $query = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($query);
        
        if($count==1)
        {
            $row = mysqli_fetch_assoc($query);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }

    }
    else
    {
        header('location:'.SITEURL);
    }

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

               
                    <div class="food-menu-img">
                    
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">
                
                    </div>
    
                    <div class="food-menu-desc">
                        <h3 class="text-white"><?php echo $title; ?></h3>
                        <p class="food-price text-blue"><?php echo $price; ?> MMK</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
               

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="09xxxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Full Address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
    
                if(isset($_POST['submit']))
                {
                    $qty = $_POST['qty'];
                    $total = $price*$qty;
                    date_default_timezone_set('Asia/Yangon');
                    $order_date = date("Y-m-d H:i:s");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customeer_contact = $_POST['contact'];
                    $customer_address = $_POST['address'];

                    $sql2 = "INSERT INTO orders SET 
                            food = '$title',
                            price = '$price',
                            qty = '$qty',
                            total = '$total',
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customeer_contact',
                            customer_address = '$customer_address'
                            ";
                    
                    $query2 = mysqli_query($conn,$sql2);

                    if($query2==true)
                    {
                        $_SESSION['order'] = '<div class="success text-center">Food ordered successfully!</div>';
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = '<div class="error text-center">Failed to Order!</div>';
                        header('location:'.SITEURL);
                    }

                }
                

            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partial/footer.php'); ?>