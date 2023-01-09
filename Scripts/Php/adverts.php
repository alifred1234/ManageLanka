<?php
// Include the database configuration file
include 'db.php';

//Delete advert
if(isset($_POST["delete_advert"])){
    $advert_id = $_POST['advert_id'];
//    delete advert from database
    $sql = "DELETE FROM adverts WHERE id = '$advert_id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $q = "success";
    }else{
        $q = "error";
    }
    header("Location: ../../adverts.php?delete=$q");
}else{
    //add or edit advert
    // get data from post

    $g_location = $_POST['g_location'];
    $g_amount = $_POST['g_amount'];
    $g_price = $_POST['g_price'];
    $g_type = $_POST['g_type'];
    $grace_period = $_POST['g_period'];
    $rep_id = $_POST['rep_id'];
    $advert_id = $_POST['advert_id'];

    $isAdd = isset($_POST["add_advert"]);
    // add advert to database
    if($isAdd){
        $sql = "INSERT INTO adverts (location, amount, type, price, grace_period, rep_id) VALUES 
                                                              ('$g_location', '$g_amount', '$g_type', '$g_price', '$grace_period'
                                                              ,'$rep_id')";

    }else{
        $sql = "UPDATE adverts SET location = '$g_location', amount = '$g_amount',
                   price = '$g_price', type = '$g_type', grace_period = '$grace_period', rep_id = '$rep_id' WHERE id = '$advert_id'";
    }
    $result = mysqli_query($conn, $sql);
    if($result){
        $q = "success";
    }else{
        $q = "error";
    }
    $isAdd ?
        header("Location: ../../adverts.php?add=$q")
        :
        header("Location: ../../adverts.php?edit=$q");

}
exit();


header("Location: ../../adverts.php?q=$param_q");
exit();
?>