<?php include('../config/constants.php'); ?>
<html>
<head>
    <title>OFDS</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login']))
        {
            echo $_SESSION['no-login'];
            unset($_SESSION['no-login']);
        }
        
        ?>
        <form action="" method="post">
            <table class="tbl-30">
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
                        <input type="submit" name="submit" value="login" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    <p></p>
    </div>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $query = mysqli_query($conn,$sql);
        
        $count = mysqli_num_rows($query);
        
        if($count == 1)
        {
            $_SESSION['login'] = '<div class="success">Login successfully</div>';
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = '<div class="error" >Login Fail!</div>';
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>