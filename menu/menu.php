<link rel="stylesheet" href="menu/menu.css">
<aside id="sidebar">
  <div class="sidebar_content sidebar_head">
    <h1>wussten Sie?</h1>
  </div>
  <div class="sidebar_content sidebar_body">
    <nav class="side_navlinks">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Account</a></li>
        <li>
          <a href="<?php echo isset($_SESSION['user_row']) ? 'logout.php' : 'login.php'; ?>">
            <?php echo isset($_SESSION['user_row']) ? 'Logout' : 'Login'; ?>
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
  <span></span>
  <span></span>
  <span></span>
</div>
<script src="menu/menu.js"></script>