<?php 
namespace App;
// session_start();
// include './app/AuthCheck.php';
   require 'vendor/autoload.php';
   include './app/AuthCheck.php';

   $user = $_SESSION['user'];

   $route = $_SERVER['REQUEST_URI'];


   
?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">

        <img src="./assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SA PORTAL</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if($user != null){?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="./uploaded_files/<?php echo $user['photo']; ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $user['fullname']; ?></a>
            </div>
        </div>
        <?php } ?>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="dashboard.php"
                        class="nav-link <?php echo $route=='/staffattendance/dashboard.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>


                <?php if($user['role'] == 'Admin') { ?>
                <li class="nav-item">
                    <a href="newstaff.php"
                        class="nav-link <?php echo $route=='/staffattendance/newstaff.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            New Staff
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="staffs.php"
                        class="nav-link <?php echo $route=='/staffattendance/staffs.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            All Staff
                        </p>
                    </a>
                </li>

                <?php }?>


                <li class="nav-item">
                    <a href="attendance.php"
                        class="nav-link <?php echo $route=='/staffattendance/attendance.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Attendance
                        </p>
                    </a>
                </li>

                <?php if($user['role'] == 'Admin') { ?>
                <li class="nav-item">
                    <a href="settings.php"
                        class="nav-link <?php echo $route=='/staffattendance/settings.php'?'active':''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <?php }?>

                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>