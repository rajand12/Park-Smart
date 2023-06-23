<link rel="stylsheet" href="../CSS/nav.css"/>
<!-- <nav>

    <img src="../Images/new-logo.PNG">
    <div id="navItems">
        <a href="index.php">Home</a>
        <a href="registration.php">Register</a>
    </div>
</nav> -->

<nav>
      <img src="../Images/new-logo.png">
      <div id="navItems">
        <ul>
          <li><a href="after-login.php">Home</a></li>
        </ul>
        <ul>
          
          <li><?= $_SESSION['user_details']['full_name'] ?>
            <ul>
              <li><a href="my-history.php">My History</a></li>
              <li><a href="user-logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>