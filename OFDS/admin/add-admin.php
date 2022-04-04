<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" placeholder="Enter Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php 
    
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        if($_POST['password']!='')
          $password = md5($_POST['password']);

        $sql = "INSERT INTO admin SET
                name = '$name',
                username = '$username',
                password = '$password'
                ";

        $query = mysqli_query($conn,$sql) or die(mysqli_error());

        if($query == true)
        {
            $_SESSION['add'] = "<div class='success'>Admin added successfully!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to add Admin!</div>";
            header("location:".SITEURL.'admin/admin.php');
        }
    }

?>
