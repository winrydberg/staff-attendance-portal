<?php
namespace App;
// session_start();
// include './app/AuthCheck.php';
require 'vendor/autoload.php';
include './includes/header.php';

use App\SQLiteConnection;



$pdo = (new SQLiteConnection())->connect();


?>
<div class="wrapper">
    <?php
        include './includes/navbar.php';
        include './includes/sidebar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    </div>
</div>

<?php
    include './includes/footer.php';
?>