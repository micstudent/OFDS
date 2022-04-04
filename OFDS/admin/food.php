<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['del']))
            {
                echo $_SESSION['del'];
                unset($_SESSION['del']);
            }

            if(isset($_SESSION['rm']))
            {
                echo $_SESSION['rm'];
                unset($_SESSION['rm']);
            }

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
            
        ?><br><br>
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br><br><br>
                <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM food";
        
                        $query = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($query);

                        $sn =1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($query))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td><img src='<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>' width="100px"></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/upd-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/del-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                <?php

                            }
                        }
                        else{
                            ?>  <tr>
                                <td colspan="7" class="error">Food not added Yet</td>
                                </tr>
                            <?php
                        }
        
                    ?>
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
