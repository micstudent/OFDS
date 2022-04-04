<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Order</h1>
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

                $sql = "SELECT * FROM orders WHERE id=$id";

                $query = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($query);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($query);
                    $food = $row['food'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                } 
                else
                {
                    $_SESSION['notfound'] =  "<div class='error'>No Order found!</div>";
                    header('location:'.SITEURL.'admin/order.php');
                    die();
                }
             }

           

            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                        <tr>
                            <td>Food: </td>
                            <td><b><i><?php echo $food; ?></i></b></td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td><b><i><?php echo $price; ?> MMK</i></b></td>
                        </tr>
                        <tr>
                            <td>Qty: </td>
                            <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                        </tr>
                        <tr>
                            <td>Status: </td>
                            <td>
                                <select name="status">
                                    <option <?php if($status=="Ordered"){ echo "selected"; } ?> value="Ordered">Ordered</option>   
                                    <option <?php if($status=="Delivering"){ echo "selected"; } ?> value="Delivering">Delivering</option>     
                                    <option <?php if($status=="Delivered"){ echo "selected"; } ?> value="Delivered">Delivered</option>   
                                    <option <?php if($status=="Cancelled"){ echo "selected"; } ?> value="Cancelled">Cencelled</option>                                       
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Name: </td>
                            <td><input type="text" name="customer_name"  value="<?php echo $customer_name; ?>"></td>
                        </tr>
                        <tr>
                            <td>Customer Contact: </td>
                            <td><input type="text" name="customer_contact"  value="<?php echo $customer_contact; ?>"></td>
                        </tr>
                        <tr>
                            <td>Customer Address: </td>
                            <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                        </tr>
                        <tr>
                        <td colspan="2" style="text-align:right;">
                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                        </tr>
                </table>
            </form>

    </div>
</div>
<?php
                    if(isset($_POST['submit']))
                    {
                        
                        $qty = $_POST['qty'];    
                        $total = $price * $qty;
                        $status = $_POST['status'];                      

                        if($_POST['customer_name']!='')
                        {
                            $customer_name = $_POST['customer_name'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Customer Name!</div>";
                            header('location:'.SITEURL.'admin/upd-order.php');
                            die();
                                }
                        
                        if($_POST['customer_contact']!='')
                        {
                            $customer_contact = $_POST['customer_contact'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Customer Contact!</div>";
                            header('location:'.SITEURL.'admin/upd-order.php');
                            die();
                                }

                        if($_POST['customer_address']!='')
                        {
                            $customer_address = $_POST['customer_address'];
                        }else{
                            $_SESSION['upload'] = "<div class='error'>Fill Customer Address!</div>";
                            header('location:'.SITEURL.'admin/upd-order.php');
                            die();
                                }
                           
                        $sql2 = "UPDATE orders SET 
                                    qty = '$qty',
                                    total = '$total',                        
                                    status = '$status',
                                    customer_name = '$customer_name',
                                    customer_address= '$customer_address',
                                    customer_contact = '$customer_contact'
                                    WHERE id=$id
                                    ";
                        $query2 = mysqli_query($conn,$sql2);

                        if($query2 == true)
                        {
                            $_SESSION['update'] = "<div class='success'>Order updated successfully!</div>";
                            header("location:".SITEURL.'admin/order.php');
                        }
                        else
                        {
                            $_SESSION['update'] = "<div class='error'>Failed to update Order!</div>";
                            header("location:".SITEURL.'admin/order.php');
                        }
                        
                    }
?>
<?php
include('partials/footer.php');
?>