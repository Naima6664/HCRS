<?php /*include "company_page.html"*/ ?>
<!DOCTYPE html>
<html style="background-color: #0dab7c">
    <heaad>
        <title>service_upload </title>
        <meta charset = "utf-8">
    </heaad>
    <body style="margin-left:500px">
    <h1 style="margin-left:-100px">Please Fill about your services</h1><br>
        <form method="post" action = "posting.php" enctype="multipart/form-data">
            <fieldset style="width:200px;height:50px">
                <legend>Type of service</legend>
                <select name="type_of_service">
                    <option value='house for rental'>rent house</option>
                    <option value='house to sell'>sell house</option>
                    <option value='car to sell'>car sell</option>
                    <option value='car for rent'>car rent</option>
                </select>
            </fieldset><br>
            Company/personal Name:<br>
            <input type="txt" name="company_name" required><br><br>
            service Name:<br>
            <input type="txt" name="product_name" required><br><br>
            Price of service:<br>
            <input type="txt" name="price" required><br><br>
            Description About service:<br>
            <textarea  name="description" rows="10" cols="25" required></textarea><br><br>
            Photo of Prodcut:
            <input type="file" name="image" required><br><br>
            
            <input type="submit" name="submit" value="submit">
            <button><a href="company_page.html">Back</a></button>
        </form>
    </body>
</html>

<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "noticeboard";

$conn = new mysqli($server,$username,$password,$dbname);
if($conn!=TRUE)
echo "error:".$conn->connect_error;

   if(isset($_POST["submit"]))
   {
       $type = $_POST['hotel'];
       $comp_name = $_POST['company_name'];
       $prod_name = $_POST['product_name'];
       $price = $_POST['price'];
       $descr = $_POST['description'];

       
       $file_name = $_FILES['image']['name'];
       $location = "images/$type/";
       $tempname = $_FILES['image']['tmp_name'];
       $target_file = $location.basename($file_name);
         
       $sql = "INSERT INTO $type(company_name, product_name, product_file, description,price) 
               VALUES('$comp_name', '$prod_name', '$file_name', '$descr', '$price')";
        $store = $conn->query($sql);
        if($store!=TRUE)
           echo "error".$conn->error;
           else
           echo "<h3 style='color:red'>Posted Successfully!</h3><br>";

       if(!empty($file_name))
       {
           $save = move_uploaded_file($tempname, $target_file);
       }
   }
  
?>

