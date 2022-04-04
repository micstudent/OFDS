<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];
        if($image_name!='')
        {
            $path = '../images/food/'.$image_name;
            if(file_exists($path))
            {
                $rm = unlink($path);
                if($rm == false)
                {
                    $_SESSION['rm'] = '<div class="error">Failed to remvoe image!</div>';
                    header('location:'.SITEURL.'admin/food.php');
                    die();
                }
            }
        }

        $sql = "DELETE FROM food WHERE id=$id";
    
        $query = mysqli_query($conn,$sql);
    
        if($query == true)
        {
            $_SESSION['del'] = '<div class="success">Food deleted successfully!</div>';
            header('location:'.SITEURL.'admin/food.php');
        }
        else{
                $_SESSION['del'] = '<div class="error">Failed to delete Food!</div>';
                header('location:'.SITEURL.'admin/food.php');
        }
    }
    else
    {
        $_SESSION['del'] = "<div class='error'>Unauthorized Access!";
        header('location:'.SITEURL.'admin/food.php');
    }