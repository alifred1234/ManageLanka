<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">

    <!-- fonts link -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link href="Bootstrap/Styles/bootstrap1.css" rel="stylesheet"/>
    <link rel="stylesheet" href="Styles/adverts.css"/>

    <title>Advertisements</title>
</head>

<body>
<?php
include 'header.php';

function isBusiness()
{
    return $_SESSION['usertype'] == "business";
}

function isMCR()
{
    return $_SESSION['role'] == "municipal";
}

if (isMCR()) {
    include "manage_adverts.php";
}
?>
<div class="container-fluid promotions mt-4" style="<?php if (!isMCR())
    echo 'overflow-x:none; overflow-y: auto; height:auto;'; ?>">
    <div class="row">
        <?php
        require 'Scripts/Php/db.php';

        if(isMCR()){
            // promotions of the business
            $query = "SELECT * FROM adverts WHERE rep_id = '".$_SESSION['id']."'";
        }
        else{
            // for non-business users
            $query = "SELECT t1.*, t2.name AS business_name, t2.contact_number AS business_contact_number
                        FROM adverts t1
                        JOIN registration t2 ON t1.rep_id = t2.id";
        }
        $result = mysqli_query($conn, $query);

        $index = 0;
        while ($row = mysqli_fetch_array($result)) {
            $index++;

            if (isMCR()) {
                // buttons to edit and delete advertisements
                $card_bottom_section = '
                <div class="row">
                      <div class="col-6">
                          <button data-object="' . htmlentities(json_encode($row)) . '" 
                          onclick="edit_advert(this, ' . $index . ')" class="w-100 btn btn-primary">Edit</button>                                               
                      </div>                                               
                      <!--Delete advertisement-->
                     <div class="col-6">
                         <form action="Scripts/Php/adverts.php" method="post">
                          <input type="hidden" name="advert_id" value="' . $row["id"] . '" >
                          <input type="submit" name="delete_advert" value="Delete" class="w-100 btn btn-danger">
                          </form>
                      </div>
                 </div>
            ';
            }
            else {
                // contact number of business
                $card_bottom_section = '
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0"><b>Contact Number: </b>' . $row["business_contact_number"] . '</p>
                    </div>
                </div>
                ';
            }
            echo ' 
                        <div class="col-6 mb-3">
                           <div class="card">
                               <div class="card-body">
                               <div class="row">
                               <div class="col-12">
                                    <h5 class="card-title">#' . $index . '</h5>
                                </div>
                                </div>
                                   <div class="row">
                                       <div class="col-6 my-auto">
                                           <p class="card-text">Location: ' . $row["location"] . '</p>
                                           <p class="card-text">Amount (in kg):' . $row["amount"] . '</p>
                                           <p class="card-text">Type of Garbage: ' . $row["type"] . '</p>
                                        
                                          
                                       </div>
                                       <div class="col-6 my-auto">
                                       <p class="card-text">Grace Period: ' . $row["grace_period"] . '</p>
                                           <p class="card-text">Price (Rs. per kg): ' . $row["price"] . '</p>
                                         
                                </div>
                                <div class="mt-2">
                                 ' . $card_bottom_section . '
                                
                                </div>                                       
                                   </div>
                               </div>
                           </div>
                       </div>  
                       ';
        }
        ?>
    </div>
</div>

<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"
></script>
<!--js to manage adverts-->
<!--for businesses-->
<?php
if (isMCR()) echo '<script src="Scripts/JavaScript/manage_adverts.js"></script>';
?>
</body>
</html>
