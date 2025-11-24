<?php
    session_start();
    
    $redirect = "";
    $name = "";
    $isSession = false;

    if(isset($_SESSION['id'])) {
        $isSession = true;
    } 
?>

<style>
:root {
  --forest-green: #2d5016;
  --leaf-green: #4a7c3f;
  --sage-green: #7fa97f;
  --sky-blue: #87ceeb;
  --earth-brown: #8b7355;
  --cream: #f5f5dc;
}

a {
  color: var(--leaf-green);
  text-decoration: none;
  transition: color 0.3s ease;
}

a:hover {
  color: var(--forest-green);
  text-decoration: underline;
}
</style>


<header class="d-flex align-items-center justify-content-between">
    <h2><a href="/assignment2">Parks and Recreation</a></h2>
    <ul class="nav" >
        <?php if($isSession) {
            echo '
                    <li class="nav-link"><a href="/assignment2/admin/parks-add.php">Add Park</a></li>
                    <li class="nav-link"><a href="/assignment2/admin/logout.php">Logout</a></li>
                ';
            } else {
                echo '
                    <li class="nav-link"><a href="/assignment2/admin/register.php">Register</a></li>
                    <li class="nav-link"><a href="/assignment2/admin/login.php">Login</a></li>
                ';
            }
        ?>
    </ul>
</header>