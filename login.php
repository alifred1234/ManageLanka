<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- fonts link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="Bootstrap/Styles/bootstrap1.css" rel="stylesheet">

  <link rel="stylesheet" href="Styles/register.css">

  <title>Login</title>
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

  if ($link == "success") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Congrats!</strong> Successful Resgistration, Welcome to ManageLanka. You may now login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  } else if ($link == "conn") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> There was a connection issue.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else if ($link == "wrongpass") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Invalid Username or Password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else if ($link == "sqlerror") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> There was an error with the database.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else if ($link == "invalidusername") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Invalid Username or Password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Welcome!</strong> Please enter your credentials to enter the website.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>

  <div class="form_wrapper">
    <div class="form_container">
      <div class="title_container">
        <h2>Login</h2>
      </div>
      <div class="row clearfix">
        <div class="">
          <form action="Scripts/Php/login.php" method="POST">

            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
              <input type="text" name="cred" placeholder="Username" required />
            </div>

            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
              <input type="password" name="password" placeholder="Password" required />
            </div>

            <input name="login" class="button" type="submit" value="Login" />
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    
</body>

</html>