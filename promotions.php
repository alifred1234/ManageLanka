<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">

    <!-- fonts link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link href="Bootstrap/Styles/bootstrap1.css" rel="stylesheet" />
    <link rel="stylesheet" href="Styles/promotions.css" />

    <title>Promotions</title>
</head>

<body>
    <?php
    include 'header.php';

    /**
     * @return bool
     */
    function isBusiness()
    {
        return $_SESSION['usertype'] == "business";
    }

    if (isBusiness()) {
        include "manage_promotions.php";
    }
    ?>
    <div class="container-fluid promotions mt-4" style="<?php if (!isBusiness())
                                                            echo 'overflow-x:none; overflow-y: auto; height:auto;'; ?>">
        <div class="row">
            <?php
            require 'Scripts/Php/db.php';

            if (isBusiness()) {
                // promotions of the business
                $query = "SELECT * FROM products WHERE business_id = '" . $_SESSION['id'] . "'";
            } else {
                // for non-business users
                $query = "SELECT t1.*, t2.company_name AS business_name, t2.contact_number AS business_contact_number
                        FROM products t1
                        JOIN registration t2 ON t1.business_id = t2.id
                        ";
            }
            $result = mysqli_query($conn, $query);

            ?>
            <?php
            $index = 0;
            while ($row = mysqli_fetch_array($result)) {
                $index++;

                if (isBusiness()) {
                    // buttons to edit and delete promotions
                    $card_bottom_section = '
                <div class="row">
                      <div class="col-6">
                          <button data-object="' . htmlentities(json_encode($row)) . '" 
                          onclick="edit_promo(this, ' . $index . ')" class="w-100 btn btn-primary">Edit</button>                                               
                      </div>                                               
                      <!--Delete promotion-->
                     <div class="col-6">
                         <form action="Scripts/Php/promotions.php" method="post">
                          <input type="hidden" name="product_id" value="' . $row["id"] . '" >
                          <input type="submit" name="delete_promotion" value="Delete" class="w-100 btn btn-danger">
                          </form>
                      </div>
                 </div>
            ';
                } else {
                    // name and contact number of business
                    $card_bottom_section = '
                <div class="row">
                    <div class="col-12">
                        <p class=""><b>Business Name: </b>' . $row["business_name"] . '</p>
                        <p class=""><b>Contact Number: </b>' . $row["business_contact_number"] . '</p>
                    </div>
                </div>
                ';
                }
                echo ' 
                        <div class="col-6 mb-3">
                           <div class="card">
                               <div class="card-body">
                                   <div class="row">
                                       <div class="col-8 my-auto">
                                           <h5 class="card-title">#' . $index . " " . $row["name"] . '</h5>
                                           <p class="card-text">Price: <s>' . $row["price"] . ' </s> <br>Discounted Price: <strong>' . $row["discounted_price"] . '</strong></p>
                                           <p class="card-text">Expiry date: ' . $row["expiry_date"] . '</p>
                                           ' . $card_bottom_section . '
                                       </div>
                                       <div class="col-4">
                                           <img
                                                   style="object-fit: cover; width: 200px; height: 200px"
                                                   src="' . $row["image_path"] . '"
                                                   class="card-img-top"
                                                   alt="..."
                                           />
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!--js to manage promotions-->
    <!--for businesses-->
    <?php
    if (isBusiness()) echo '<script src="Scripts/JavaScript/manage_promotions.js"></script>';
    ?>
</body>

</html>