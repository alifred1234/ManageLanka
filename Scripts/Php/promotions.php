<?php
// Include the database configuration file
include 'db.php';

//Delete promotion
if(isset($_POST["delete_promotion"])){
    $product_id = $_POST['product_id'];
//    delete product from database
    $sql = "DELETE FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $q = "success";
    }else{
        $q = "error";
    }
    header("Location: ../../promotions.php?delete=$q");
    exit();
}

//form data
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$discounted_price = $_POST['discounted_price'];
$business_id = $_POST['business_id'];
$product_image = $_FILES["product_image"]["name"];
$expiry_date = $_POST['expiry_date'];

// File upload path
$abs_dir_path = "Images/products/";
$targetDir = "../../Images/products/";
$fileName = basename($product_image);
$new_image_name = $business_id ."_". $product_name."_". $fileName;
$targetFilePath = $targetDir . $new_image_name;
$image_location = $abs_dir_path .$new_image_name;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$param_q = "";

if ((isset($_POST["add_promotion"]) || isset($_POST["edit_promotion"]))
    && !empty($product_image)) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {

        // Upload file to server
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            $stmt = mysqli_stmt_init($conn);
            if(isset($_POST["add_promotion"])){
                $sql = "INSERT INTO products (
                name, price, discounted_price, image_path, expiry_date, business_id) VALUES (?, ?, ?, ?, ?, ?)";
            }else{

                $sql = "UPDATE products SET name = ?, price = ?, discounted_price = ?, image_path = ?, expiry_date = ? WHERE id = ?";
            }
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $param_q = "sqlerror";
            } else {
                if(isset($_POST["add_promotion"])){
                    $sql = "INSERT INTO products (
                name, price, discounted_price, image_path, expiry_date, business_id) VALUES (?, ?, ?, ?, ?, ?)";
                    mysqli_stmt_bind_param($stmt, "sddsss",
                        $product_name, $product_price, $discounted_price, $image_location,
                        $expiry_date, $business_id);
                }else{
                    $sql = "UPDATE products SET name = ?, price = ?, discounted_price = ?, image_path = ?, expiry_date = ? WHERE id = ?";
                    $product_id = $_POST['product_id'];
                    mysqli_stmt_bind_param($stmt, "sddssd",
                        $product_name, $product_price, $discounted_price, $image_location,
                        $expiry_date, $product_id);
                }
                //add information to DB
                $insert = mysqli_stmt_execute($stmt);
                if ($insert) {
                    $param_q = "added";
                } else {
                    $param_q = "failed";
                }
            }

        } else {
            $param_q = "failed";
        }
    } else {
        $param_q = "type";
    }
} else {
    $param_q = "noinput";
}
header("Location: ../../promotions.php?q=$param_q");
exit();
?>