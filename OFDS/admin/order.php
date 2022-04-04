<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <?php
                 
                 if(isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                 }

                 if(isset($_SESSION['notfound']))
                 {
                     echo $_SESSION['notfound'];
                     unset($_SESSION['notfound']);
                 }

                 if(isset($_SESSION['del']))
                 {
                     echo $_SESSION['del'];
                     unset($_SESSION['del']);
                 }
            ?>
            <br><br>
                <a href="#" class="btn-primary">Add order</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM orders ORDER BY `orders`.`id` DESC";
                        $query = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($query);
                        $sn = 1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($query))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_address = $row['customer_address'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                        <?php 
                                            if($status=="Ordered") 
                                            {
                                                echo "<label style='color: rgb(255, 255, 255);
                                                background-color: blue;
                                                width: 25%;
                                                padding: 3px;
                                                text-align: center;'>$status</label>";
                                            }
                                            elseif($status=="Delivering")
                                            {
                                                echo "<label style='color: rgb(255, 255, 255);
                                                background-color: orange;
                                                width: 25%;
                                                padding: 3px;
                                                text-align: center;'>$status</label>";
                                            }
                                            elseif($status=="Delivered")
                                            {
                                                echo "<label style='color: rgb(255, 255, 255);
                                                background-color: green;
                                                width: 25%;
                                                padding: 3px;
                                                text-align: center;'>$status</label>";
                                            }
                                            elseif($status=="Cancelled")
                                            {
                                                echo "<label style='color: rgb(255, 255, 255);
                                                background-color: red;
                                                width: 25%;
                                                padding: 3px;
                                                text-align: center;'>$status</label>";
                                            }
                                        ?>
                                        </td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/upd-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/del-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else{
                            echo "<tr><td colspan='12' class='error'>Order is available</td></tr>";
                        }
                    ?>
                    
                </table>      
    </div>
</div>

<?php include('partials/footer.php'); ?>
