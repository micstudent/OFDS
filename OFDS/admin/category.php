<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>

            <?php
                 if(isset($_SESSION['add']))
                 {
                     echo $_SESSION['add'];
                     unset($_SESSION['add']);
                 }
                 if(isset($_SESSION['rm']))
                 {
                     echo $_SESSION['rm'];
                     unset($_SESSION['rm']);
                 }
                 if(isset($_SESSION['del']))
                 {
                     echo $_SESSION['del'];
                     unset($_SESSION['del']);
                 }
                 if(isset($_SESSION['notfound']))
                 {
                     echo $_SESSION['notfound'];
                     unset($_SESSION['notfound']);
                 }
                 if(isset($_SESSION['upd']))
                 {
                     echo $_SESSION['upd'];
                     unset($_SESSION['upd']);
                 }
            ?>
            <br><br>
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM category  ORDER BY category.id ASC";
        
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
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td><img src='<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>' width="100px"></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/upd-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/del-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                <?php

                            }
                        }
                        else{
                            ?>

                            <?php
                        }
        
                    ?>
                    
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
