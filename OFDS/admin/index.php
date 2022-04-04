<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                ?>
                <div class="col-4 text-center">
                <?php
                
                    $sql = "SELECT * FROM category";
                    $query = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($query);

                ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                <?php
                
                    $sql2 = "SELECT * FROM food";
                    $query2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($query2);

                ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
                </div>

                <div class="col-4 text-center">
                <?php
                
                    $sql3 = "SELECT * FROM orders";
                    $query3 = mysqli_query($conn,$sql3);
                    $count3 = mysqli_num_rows($query3);

                ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Total Orders
                </div>

                <div class="col-4 text-center">
                <?php
                
                    $sql4 = "SELECT SUM(total) AS Total FROM orders WHERE status='Delivered'";
                    $query4 = mysqli_query($conn,$sql4);
                    $row = mysqli_fetch_assoc($query4);
                    $revenue = $row['Total'];

                ?>
                    <h1><?php if($revenue==''){echo "0"; }else {echo $revenue;} ?> MMK</h1>
                    <br>
                    Revenue 
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
       
<?php include('partials/footer.php'); ?>