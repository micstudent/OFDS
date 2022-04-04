<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1>
            <br><br>
            <?php
                 
                 if(isset($_SESSION['upload']))
                 {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
                 }
            ?>
            <?php

             if(isset($_GET['id']))
             {
                $id = $_GET['id'];

                $sql = "SELECT * FROM category WHERE id=$id";

                $query = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($query);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($query);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } 
                else
                {
                    $_SESSION['notfound'] =  "<div class='error'>No Category found!</div>";
                    header('location:'.SITEURL.'admin/category.php');
                }
             }

           

            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="category title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td><img src="<?php echo SITEURL; ?>images/category/<?php print $current_image; ?>" alt="image" width="100px"></td>
                    </tr>
                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                        <input type="radio" name="featured" value="Yes" id="r1" <?php if($featured=='Yes'){print 'checked="checked"';} ?>><label for="r1"> Yes</label>
                        <input type="radio" name="featured" value="No"  id="r2" <?php if($featured=='No'){print 'checked="checked"';} ?>><label for="r2"> No</label> 
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                        <input type="radio" name="active" value="Yes" id="r3" <?php if($active=='Yes'){print 'checked="checked"';} ?>><label for="r3"> Yes</label>
                        <input type="radio" name="active" value="No"  id="r4" <?php if($active=='No'){print 'checked="checked"';} ?>><label for="r4"> No</label>
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2" style="text-align:right;">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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

        if($_POST['title']!='')
        {
            $title = $_POST['title'];
        }else{
            $_SESSION['upload'] = "<div class='error'>Fill Title!</div>";
            header('location:'.SITEURL.'admin/upd-category.php?id='.$id.'&image_name='.$current_image);
            die();
        }
        
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $image_name = $_FILES['image']['name'];
        if($image_name !='')
        {
            $image_name = $_FILES['image']['name'];
            $extension = explode("/",$_FILES['image']['type']);
            $d = new DateTime();
            $image_name = "category_".$d->format('y_m_d_His').".".$extension[1];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
            $upload = move_uploaded_file($source_path,$destination_path);
            
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload!</div>";
                header('location:'.SITEURL.'admin/upd-category.php');
                die();
            }
            $rm_img='../images/category/'.$current_image;
            $rm = unlink($rm_img);
            if($rm==false)
            {
                $_SESSION['rm'] = "<div class='error'>Failed to remove Image!</div>";
                header('location:'.SITEURL.'admin/category.php');die();
            }
        }
        else
        {
            $image_name = $current_image;
        }
        
        $sql = "UPDATE category SET
        title = '$title',
        featured = '$featured',
        active = '$active',
        image_name ='$image_name'
        WHERE id=$id";
        
        $query = mysqli_query($conn,$sql);

        if($query == true)
        {
            $_SESSION['upd'] = "<div class='success'>Category updated successfully!</div>";
            header("location:".SITEURL.'admin/category.php');
        }
        else
        {
            $_SESSION['upd'] = "<div class='error'>Failed to update Category!</div>";
            header("location:".SITEURL.'admin/category.php');
        }
    }

?>