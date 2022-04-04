<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Food</h1>
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
                        <td><input type="text" name="title" placeholder="Food title"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" placeholder="Food Description" cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"></td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
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
                <?php
                    if(isset($_POST['submit']))
                    {
                        if($_POST['title']!='')
                        {
                            $title = $_POST['title'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Title!</div>";
                            header('location:'.SITEURL.'admin/add-food');
                            die();
                    }
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];                        
                        $image_name = $_FILES['image']['name'];
                        if($image_name!='')
                        {
                            $extension = explode("/",$_FILES['image']['type']);
                            $d = new DateTime();
                            $image_name = "food_".$d->format('y_m_d_His').".".$extension[1];
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;
                            $upload = move_uploaded_file($source_path,$destination_path);

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to load image!</div>";
                                header('location:'.SITEURL.'admin/add-food.php');die();
                            }
                        }
                        else
                        {
                            $_SESSION['upload'] = "<div class='error'>No image is selected!</div>";
                            header('location:'.SITEURL.'admin/add-food.php');die();
                        }
                        $sql2 = "INSERT INTO food (title,description,price,image_name,category_id,featured,active) VALUES( 
                                    '$title',
                                    '$description',
                                     $price,
                                    '$image_name',
                                    '$category',
                                    '$featured',
                                    '$active');
                                    ";
                        $query2 = mysqli_query($conn,$sql2);
						
                        if($query2 == true)
                        {
                            $_SESSION['add'] = "<div class='success'>Food added successfully!</div>";
                            header("location:".SITEURL.'admin/food.php');
                        }
                        else
                        {
                            $_SESSION['add'] = "<div class='error'>Failed to add Food!</div>";
							unlink($destination_path);
                            header("location:".SITEURL.'admin/food.php');
                        }
                        
                    }
                ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>