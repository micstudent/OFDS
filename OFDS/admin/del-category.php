<?php
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if($image_name!='')
    {
        $path = '../images/category/'.$image_name;
        if(file_exists($path))
        {
            $rm = unlink($path);
            if($rm == false)
            {
                $_SESSION['rm'] = '<div class="error">Failed to remvoe image!</div>';
                header('location:'.SITEURL.'admin/category.php');
                die();
            }
        }
    }

    $sql = "DELETE FROM category WHERE id=$id";
    
    $query = mysqli_query($conn,$sql);

    if($query == true)
    {
        $_SESSION['del'] = '<div class="success">Category deleted successfully!</div>';
        header('location:'.SITEURL.'admin/category.php');
    }
    else{
            $_SESSION['del'] = '<div class="error">Failed to delete category !</div>';
                    header('location:'.SITEURL.'admin/category.php');
    }
}
else
{
    header('location:'.SITEURL.'admin/category.php');
}

?>