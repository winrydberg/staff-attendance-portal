<?php
namespace App;
// session_start();
// include './app/AuthCheck.php';
require 'vendor/autoload.php';
include './includes/header.php';

use App\SQLiteConnection;
use App\SQLiteInsert;
use App\SQLiteSelect;



$pdo = (new SQLiteConnection())->connect();
$sel = new SQLiteSelect((new SQLiteConnection())->connect());

$setting = $sel->getSettings();

if($_POST){
    $date = $_POST['date'] ==null?date('Y-m-d'):$_POST['date'] ;
     
    $attendance = $sel->getAttendance($date);

    // \var_dump("======================================>",$date, $attendance);
}


?>
<div class="wrapper">
    <?php
        include './includes/navbar.php';
        include './includes/sidebar.php';
    ?>

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
                            <li class="breadcrumb-item"><a href="#">Staff Attendance</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Attendance</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8">
                                    <form action="attendance.php" method="post" class="form-vertical">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" name="date" class="form-control"
                                                        placeholder="Reporting Time" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        Get Attendance
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <hr />

                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Staff Name</th>
                                                <th>Staff Email</th>
                                                <th>Entry Date</th>
                                                <th>Entry Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($attendance as $a){ ?>

                                            <tr>
                                                <td><?php echo $a['staff']['fullname'];?></td>
                                                <td><?php echo $a['staff']['email'];?></td>
                                                <td><?php echo $a['entrydate'];?></td>
                                                <td><?php echo $a['entrytime'];?></td>
                                                <td>
                                                    <?php if($a['entrytime'] > $setting['value']){ ?>
                                                    <span class="badge badge-danger">Came Late</span>
                                                    <?php }else{ ?>
                                                    <span class="badge badge-success">On Time</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Staff Name</th>
                                                <th>Staff Email</th>
                                                <th>Entry Date</th>
                                                <th>Entry Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
</div>

<script>
$(document).ready(function() {

})
</script>

<?php
    include './includes/footer.php';
?>