<link rel="stylesheet" href="menu/menu.css">

<?php $is_loggedin=isset($_SESSION['user_row']) ?>

<aside id="sidebar">
  <div class="sidebar_content sidebar_head">
    <h1>wussten Sie?</h1> <!-- Título da barra lateral -->
  </div>
  <div class="sidebar_content sidebar_body">
    <nav class="side_navlinks">
      <ul>
        <?php
      if($is_loggedin) {

        echo "<li><a href='main.php'> Home</a></li>"; // Item do menu "Home"
       /*  echo "<li><a href='account.php'>Account</a></li>"; */ // Item do menu "Conta"
      }
        ?>
        <li>
          <a href="<?php echo $is_loggedin ? 'logout.php' : 'login.php'; ?>">
            <?php echo $is_loggedin ? 'Logout' : 'Login'; ?>
          </a>
        </li>
        <li><a href="about.php">Sobre</a></li> <!-- Item do menu "Sobre" -->
        <!-- <li><a href="#">Contact</a></li> --> <!-- Item do menu "Contato" -->
      </ul>
    </nav>
  </div>
  <div class="sidebar_content sidebar_foot">
    <a href="https://github.com/Random-user-doing-random-stuff/test1" target="_blank">GitHub</a> <!-- Link para o GitHub -->
  </div>
</aside>

<div class="sidebar_toggler">
  <span class="slidebar-arrow"></span>
  <span class="slidebar-arrow"></span>
  <span class="slidebar-arrow"></span>
</div>

<script src="menu/menu.js"></script>