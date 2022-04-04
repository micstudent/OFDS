<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>
        <?php

            $id = $_GET['id'];

            $sql = "SELECT * FROM admin WHERE id=$id";

            $query = mysqli_query($conn,$sql);

            if($query == true)
            {
                $count = mysqli_num_rows($query);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($query);
                    $name = $row['name'];
                    $username = $row['username'];
                }else{
                    header('location:'.SITEURL.'admin/admin.php');
                }
            }

        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <input type="hidden" value="<?php echo $id; ?>" name="id">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        
        
            $sql = "UPDATE admin SET
                name = '$name',
                username = '$username'
                WHERE id = '$id'
                ";
        
        
        $query = mysqli_query($conn,$sql) or die(mysqli_error());

        if($query == true)
        {
            $_SESSION['upd'] = "<div class='success'>Admin updated successfully!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
        else
        {
            $_SESSION['upd'] = "<div class='error'>Failed to update Admin!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
    }
?>
<?php include('partials/footer.php'); ?>