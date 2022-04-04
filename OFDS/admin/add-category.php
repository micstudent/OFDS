<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Category</h1>
            <br><br>
            <?php
                 
                 if(isset($_SESSION['upload']))
                 {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
                 }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="category title"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                        <input type="radio" name="featured" value="Yes" id="r1"><label for="r1"> Yes</label>
                        <input type="radio" name="featured" value="No" checked="checked" id="r2"><label for="r2"> No</label> 
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                        <input type="radio" name="active" value="Yes" id="r3"><label for="r3"> Yes</label>
                        <input type="radio" name="active" value="No" checked="checked" id="r4"><label for="r4"> No</label>
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2" style="text-align:right;">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
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
            header('location:'.SITEURL.'admin/add-category');
            die();
        }
        
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        
        $image_name = $_FILES['image']['name'];
        if($image_name!='')
        {
        
            $extension = explode("/",$_FILES['image']['type']);
            $d = new DateTime();
            $image_name = "category_".$d->format('y_m_d_His').".".$extension[1];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
            $upload = move_uploaded_file($source_path,$destination_path);
            
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>No image is selected!</div>";
                header('location:'.SITEURL.'admin/add-category.php');die();
            }
        }
        else
        {
            $_SESSION['upload'] = "<div class='error'>No image is selected!</div>";
            header('location:'.SITEURL.'admin/add-category.php');die();
        }
        
        $sql = "INSERT INTO category SET
        title = '$title',
        featured = '$featured',
        active = '$active',
        image_name ='$image_name'
        ";
        
        $query = mysqli_query($conn,$sql) or die(mysqli_error());

        if($query == true)
        {
            $_SESSION['add'] = "<div class='success'>Category added successfully!</div>";
            header("location:".SITEURL.'admin/category.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to add Category!</div>";
            header("location:".SITEURL.'admin/category.php');
        }
    }

?>