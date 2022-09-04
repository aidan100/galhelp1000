<nav class="navbar custom-navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href='index.php'>
      <p class="logo" >STUDENT.GRADE.CALCULATOR</p>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a href="index.php" class="navbar-item custom-item">
        Home
      </a>

      
    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== false) {
    ?>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href='logout.php' class="button is-primary custom-button">
              <strong>Log Out</strong>
            </a>
          </div>
        </div>
      </div>
    <?php
    } else {
    ?>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a href='signup.php' class="button is-primary custom-button">
              <strong>Sign up</strong>
            </a>
            <a href='signin.php' class="button is-light custom-button">
              Log in
            </a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</nav>
</body>