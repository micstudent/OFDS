<?php

    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id=$id";

    $query = mysqli_query($conn,$sql);

    if($query == true)
    {
        $_SESSION['del'] = '<div class="success">Admin deleted successfully!</div>';
        header('location:'.SITEURL.'/admin/admin.php');
    }
    else
    {
        $_SESSION['del'] = '<div class="error">Failed to delete Admin!</div>';
        header('location:'.SITEURL.'/admin/admin.php');
    }
?>