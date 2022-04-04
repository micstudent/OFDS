<?php

    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE id=$id";

    $query = mysqli_query($conn,$sql);

    if($query == true)
    {
        $_SESSION['del'] = '<div class="success">Order deleted successfully!</div>';
        header('location:'.SITEURL.'/admin/order.php');
    }
    else
    {
        $_SESSION['del'] = '<div class="error">Failed to delete Order!</div>';
        header('location:'.SITEURL.'/admin/order.php');
    }
?>