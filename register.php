<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fonts link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="Bootstrap/Styles/bootstrap1.css" rel="stylesheet">

    <link rel="stylesheet" href="Styles/register.css">

    <title>Registration</title>
</head>

<body>
    <header id="header">
        <!-- NAV BAR -->
        <nav class="nav">
            <!-- LOGO -->
            <div class="logo">
                <a id="logo-text" href="index.php">ManageLanka</a>
            </div>
        </nav>
    </header>

    <?php
    $link = "";
    if ($_GET) {
        $link = $_GET['q'];
    }

    if ($link == "passunmatch") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Your passwords did not match, Please re-enter.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else if ($link == "invalidmail") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Your email was invalid, Please use the correct format for a email.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else if ($link == "sqlerror") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> There was an error connecting to the database.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else if ($link == "usertaken") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Sorry, this username is already taken, try something unique.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Welcome!</strong> Please enter your details and register with us.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    }
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Register</h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <!-- first name and last name in single row -->
                    <form action="Scripts/Php/registration.php" method="POST">
                        <div class="row clearfix">
                            <div class="col_half">
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                    <input type="text" name="fname" placeholder="First Name" required />
                                </div>
                            </div>
                            <div class="col_half">
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                    <input type="text" name="lname" placeholder="Last Name" required />
                                </div>
                            </div>
                        </div>
                        <!-- email -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <!-- username -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="text" name="username" placeholder="Username" required />
                        </div>
                        <!-- password -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password1" placeholder="Password" required />
                        </div>
                        <!-- re-typed password -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password2" placeholder="Re-type Password" required />
                        </div>

                        <!-- radio button to select the user type -->
                        <div class="radio_container">
                            <div>
                                <input onchange="radio()" type="radio" name="usertype" value="citizen" id="citizen">
                                <label for="citizen">Citizen</label>
                            </div>
                            <div>
                                <input onchange="radio()" type="radio" name="usertype" value="business" id="business">
                                <label for="business">Business</label>
                            </div>
                            <div>
                                <input onchange="radio()" type="radio" name="usertype" value="admin" id="admin">
                                <label for="admin">Admin</label>
                            </div>
                        </div>

                        <!-- dropdown to choose role -->
                        <div class="input_field select_option hidden" id="list1">
                            <select id="user" onchange="change()" name="role" required>
                                <option value="default" disabled selected hidden>Choose your role</option>
                                <option value="citizen">Citizen</option>
                                <option value="municipal">Municipal Council</option>
                                <option value="recycler">Recycling Company</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="retailer">Retailer</option>
                                <option value="volunteer">Volunteer Group</option>
                                <option value="admin">Admin</option>
                            </select>
                            <div class="select_arrow"></div>
                        </div>

                        <!-- role dependent fields -->

                        <div id="fields">

                            <!-- MCR + citizen -->
                        
                            <div class="input_field select_option hidden" id="district">
                                <select name="district">
                                    <option value="" disabled selected hidden>Choose your District</option>
                                    <option value="1">District 1</option>
                                    <option value="2">District 2</option>
                                    <option value="3">District 3</option>
                                    <option value="4">District 4</option>
                                    <option value="5">District 5</option>
                                </select>
                                <div class="select_arrow"></div>

                            </div>

                            <!-- citizen -->
                            <div class="input_field hidden" id="NID"> <span><i aria-hidden="true"
                                        class="fa fa-id-card"></i></span>
                                <input type="text" name="NID" placeholder="National ID" />
                            </div>

                            <!-- admin -->
                            <div class="input_field hidden" id="adminID"> <span><i aria-hidden="true"
                                        class="fa fa-id-card"></i></span>
                                <input type="text" name="adminID" placeholder="Admin ID" />
                            </div>

                            <!-- MCR -->
                            <div class="input_field hidden" id="repID"> <span><i aria-hidden="true"
                                        class="fa fa-id-card"></i></span>
                                <input type="text" name="repID" placeholder="Reprentative ID" />
                            </div>

                            <!-- recycling company + restaurant + retailer -->
                            <div class="input_field hidden" id="company"> <span><i aria-hidden="true"
                                        class="fa fa-building"></i></span>
                                <input type="text" name="company" placeholder="Company Name" />
                            </div>

                            <!-- recycling company + restaurant + retailer -->
                            <div class="input_field hidden" id="businessID"> <span><i aria-hidden="true"
                                        class="fa fa-id-card"></i></span>
                                <input type="text" name="businessID" placeholder="Business ID" />
                            </div>

                            <!-- volunteer group -->
                            <div class="input_field hidden" id="group"> <span><i aria-hidden="true"
                                        class="fa fa-users"></i></span>
                                <input type="text" name="group" placeholder="Group Name" />
                            </div>
                        </div>


                        <input name="signup" class="button" type="submit" value="Register" />
                        <p class="message">Already registered? <a href="login.php">Sign in</a></p>
                        <p class="message">Go to <a href="index.php">Home page</a></p>
                        <p  class="message">Find out which district you are from -> <a
                            href="https://www.colombo.mc.gov.lk/admin-districts.php#prettyPhoto">Here</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="Scripts/JavaScript/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>