<link rel="stylesheet" href="menu/menu.css">
<?php $is_loggedin=isset($_SESSION['user_row']) ?>
<aside id="sidebar">
  <div class="sidebar_content sidebar_head">
    <h1>wussten Sie?</h1>
  </div>
  <div class="sidebar_content sidebar_body">
    <nav class="side_navlinks">
      <ul>
        <?php
      if($is_loggedin) {

        echo "<li><a href='main.php'> Home</a></li>";
        echo "<li><a href='account.php'>Account</a></li>";
      }
        ?>
        <li>
          <a href="<?php echo $is_loggedin ? 'logout.php' : 'login.php'; ?>">
            <?php echo $is_loggedin ? 'Logout' : 'Login'; ?>
          </a>
        </li>
        <li><a href="about.php">About</a></li>
        <!-- <li><a href="#">Contact</a></li> -->
      </ul>
    </nav>
  </div>
  <div class="sidebar_content sidebar_foot">
    <p>Sidebar Footer</p>
  </div>
</aside>
<div class="sidebar_toggler">
  <span class="slidebar-arrow"></span>
  <span class="slidebar-arrow"></span>
  <span class="slidebar-arrow"></span>
</div>
<script src="menu/menu.js"></script>