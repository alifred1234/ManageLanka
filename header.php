<link rel="stylesheet" href="Styles/header.css">

<header id="header">
    <!-- NAV BAR -->
    <nav class="nav">
        <!-- LOGO -->
        <div class="logo">
            <a id="logo-text" href="index.php">ManageLanka</a>
        </div>

        <?php
        $navOptions = array(
            'citizen' => array(
                ['Schedules' => 'schedules.php'],
                ['Promotions'=> 'promotions.php'],
                ['Events'=> 'events.php'],
            ),
            'municipal' => array(
                ['Schedules' => 'schedules.php'],
                ['Advertisements' => 'adverts.php'],
                ['Chat with citizens' => 'mcr_chat.php'],
            ),
            'restaurant' => array(
                ['Promotions'=> 'promotions.php'],
                ['Donations' => 'donations.php'],
            ),

            'retailer' => array(
                ['Promotions'=> 'promotions.php'],
                ['Donations' => 'donations.php'],
            ),
            'recycler' => array(
                ['Advertisements'=> 'adverts.php'],
            ),
        );

        $role = $_SESSION['role'] ?? '';
        $options = $navOptions[$role] ?? array();

        if (!empty($options)) {
            echo '<ul class="nav-list">';
            foreach ($options as $option) {
                $key = array_keys($option)[0];
                echo "<li class='nav-item'>
                <a href='{$option[$key]}' class='nav-link'>{$key}</a>
                </li>";
            }
            echo '</ul>';
        }

        if (isset($_SESSION['username'])) {
            echo "<section class=\"para\"><p>You are logged in</p></section>
            <section class=\"para\"><p>Hi {$_SESSION['username']}. Your Role: {$_SESSION['role']}</p></section><br />
            <form action=\"Scripts/Php/logout.php\" method=\"POST\">
                <button type=\"submit\" name=\"logout\" class=\"btn-grouped\">Logout</button>
            </form>
            ";

        } else {
            // if session is closed, it will show a signin and login option
            echo '
            <section class="para"><p>You are logged out</p></section>
            <button><a href="login.php" class="btn-grouped">Login</a></button>
            <button><a href="register.php" class="btn-grouped">Sign Up</a></button>';
        }
        ?>
    </nav>
</header>