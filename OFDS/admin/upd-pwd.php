<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <?php
                $id = $_GET['id'];
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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

        if($_POST['password']!='')
        {
          $password = md5($_POST['password']);
        
        
            $sql = "UPDATE admin SET
                password = '$password'
                WHERE id = '$id'
                ";
        }else{
            $_SESSION['pwd'] = "<div class='success'>Nothing changed!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
        
        
        $query = mysqli_query($conn,$sql);

        if($query == true)
        {
            $_SESSION['pwd'] = "<div class='success'>Password changed successfully!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
        else
        {
            $_SESSION['pwd'] = "<div class='error'>Failed to change password!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
    }
?>
<?php include('partials/footer.php'); ?>