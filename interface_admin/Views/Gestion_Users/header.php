
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center" style="height: 80px;">

<div class="d-flex align-items-center justify-content-between">
  <a href="../index.php" >
    <img src="../../img/USTHB.png" style="width: 200px; height:170px;" >
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->


<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo  $_SESSION['user'] ?> </span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo  $_SESSION['user'] ?> </h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        
        
        <li>
          <a class="dropdown-item d-flex align-items-center" href="../Views/profile_user.php">
          <i class="bi bi-person"></i>
          <span>Mon Profile</span>
          </a>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>
        
        <li>
          <a class="dropdown-item d-flex align-items-center" href="../../login/logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Deconnexion</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->