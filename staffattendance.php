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

if($_GET['staffid']){
    $staffid = $_GET['staffid'];
    $staff = $sel->getStaff($staffid);
}else{
    header('Location: staffs.php');
}

if($_POST['startdate'] && $_POST['enddate']){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
     
    $attendance = $sel->getStaffAttendance($startdate, $enddate);

    // \var_dump("======================================>",$date, $attendance);
}

$setting = $sel->getSettings();



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
                                <h3 class="card-title"><?php echo $staff['fullname'] ?> Attendance</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form action="staffattendance.php?staffid=<?php echo $staff['staffid'] ?>"
                                        method="POST" class="form-vertical">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" name="startdate" class="form-control"
                                                        placeholder="Reporting Time" />
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" name="enddate" class="form-control"
                                                        placeholder="Reporting Time" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button type="submit" style="margin-top: 30px;"
                                                        class="btn btn-primary btn-block">
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
                                                <td><?php echo $staff['fullname'];?></td>
                                                <td><?php echo $staff['email'];?></td>
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