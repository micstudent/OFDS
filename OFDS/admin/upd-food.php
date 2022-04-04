<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
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

                $sql = "SELECT * FROM food WHERE id=$id";

                $query = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($query);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($query);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } 
                else
                {
                    $_SESSION['notfound'] =  "<div class='error'>No Food found!</div>";
                    header('location:'.SITEURL.'admin/food.php');
                }
             }

           

            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                        <tr>
                            <td>Title: </td>
                            <td><input type="text" name="title" placeholder="Food title" value="<?php echo $title; ?>"></td>
                        </tr>
                        <tr>
                        <td>Current Image: </td>
                        <td><img src="<?php echo SITEURL; ?>images/food/<?php print $current_image; ?>" alt="image" width="100px"></td>
                        </tr>
                        <tr>
                            <td>Select Image: </td>
                            <td><input type="file" name="image"></td>
                        </tr>
                        <tr>
                            <td>Description: </td>
                            <td><textarea name="description" placeholder="Food Description" cols="30" rows="10"><?php echo $description; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                        </tr>
                        <tr>
                            <td>Category: </td>
                            <td><select name="category" id="">
                            <?php
                                $sql = "SELECT * FROM category WHERE active='Yes'";
                                $query = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($query);
                                if($count>0)
                                {   
                                    while($row=mysqli_fetch_assoc($query))
                                    {   
                                        $i = $row['id'];
                                        $title = $row['title'];
                                        if($i == $category_id)
                                        {
                                        ?>
                                        <option value="<?php echo $i; ?>" selected><?php echo $title; ?></option>
                                        <?php } else {  ?>
                                        <option value="<?php echo $i; ?>"><?php echo $title; ?></option>
                                        <?php  }
                                    }
                                    
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                            ?>                        
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Featured: </td>
                            <td>
                            <input type="radio" name="featured" value="Yes" id="r1" <?php if($featured == 'Yes'){echo 'checked="checked"';} ?>><label for="r1"> Yes</label>
                            <input type="radio" name="featured" value="No"  id="r2" <?php if($featured == 'No'){echo 'checked="checked"';} ?>><label for="r2"> No</label> 
                            </td>
                        </tr>
                        <tr>
                        <td>Active: </td>
						<td>
							<input type="radio" name="active" value="Yes" id="r3" <?php if($active=='Yes'){print 'checked="checked"';} ?>><label for="r3"> Yes</label>
							
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

<?php
                    if(isset($_POST['submit']))
                    {
                        if($_POST['title']!='')
                        {
                            $title = $_POST['title'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Title!</div>";
                            header('location:'.SITEURL.'admin/upd-food');
                            die();
                                }

                        if($_POST['description']!='')
                        {
                            $description = $_POST['description'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Description!</div>";
                            header('location:'.SITEURL.'admin/upd-food');
                            die();
                                }
                        
                        if($_POST['price']!='')
                        {
                            $price = $_POST['price'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Price!</div>";
                            header('location:'.SITEURL.'admin/upd-food');
                            die();
                                }

                        $category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];                    
                        $image_name = $_FILES['image']['name'];
                        if($image_name !='')
                        {
                            $image_name = $_FILES['image']['name'];
                            $extension = explode("/",$_FILES['image']['type']);
                            $d = new DateTime();
                            $image_name = "food_".$d->format('y_m_d_His').".".$extension[1];
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;
                            $upload = move_uploaded_file($source_path,$destination_path);
                            
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload!</div>";
                                header('location:'.SITEURL.'admin/upd-food.php');
                                die();
                            }

                            $rm_img='../images/food/'.$current_image;

                            if(unlink($rm_img)==false)
                            {
                                $_SESSION['rm'] = "<div class='error'>Failed to remove Image!</div>";
                                header('location:'.SITEURL.'admin/food.php');die();
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                        $sql2 = "UPDATE food SET 
                                    title = '$title',
                                    description = '$description',
                                    price = '$price',
                                    image_name = '$image_name',
                                    category_id = '$category',
                                    featured= '$featured',
                                    active = '$active'
                                    WHERE id=$id";
                        $query2 = mysqli_query($conn,$sql2);

                        if($query2 == true)
                        {
                            $_SESSION['update'] = "<div class='success'>Food updated successfully!</div>";
                            header("location:".SITEURL.'admin/food.php');
                        }
                        else
                        {
                            $_SESSION['update'] = "<div class='error'>Failed to update Food!</div>";
                            header("location:".SITEURL.'admin/food.php');
                        }
                        
                    }
?>
<?php include('partials/footer.php'); ?>

