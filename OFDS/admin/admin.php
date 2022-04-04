<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Admin Manager</h1>
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
                        if(isset($_SESSION['upd']))
                        {
                            echo $_SESSION['upd'];
                            unset($_SESSION['upd']);
                        }
                        if(isset($_SESSION['pwd']))
                        {
                            echo $_SESSION['pwd'];
                            unset($_SESSION['pwd']);
                        }
                    ?>
                <br><br>
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM admin ORDER BY id ASC";

                        $query = mysqli_query($conn,$sql) or die(mysqli_error());

                        if($query == true)
                        {
                            $count = mysqli_num_rows($query);
                            $no = 1;
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($query))
                                {
                                    $id = $rows['id'];
                                    $name = $rows['name'];
                                    $username = $rows['username'];

                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $username ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/upd-pwd.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/upd-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/del-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {

                            }
                        }
                    ?>
                    
                </table>

            </div>
        </div>
        
<?php include('partials/footer.php'); ?>
