<?php
namespace App;

include './app/AuthCheck.php';
require 'vendor/autoload.php';
include './includes/header.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteCreateTable as SQLiteCreateTable;
use App\SQLiteSelect;

// $sqlite = new SQLiteCreateTable((new SQLiteConnection())->connect());
// create new tables
// $sqlite->createTables();
// // get the table list
// $tables = $sqlite->getTableList();
// var_dump($tables);


$user = $_SESSION['user'];



$sel = new SQLiteSelect((new SQLiteConnection())->connect());

$staffCount =  $sel->getStaffCount();
$count = $sel->getTodayAttendance($user['staffid'], date('Y-m-d'));
$latecount = $sel->getLateCount();
$earlycount = $sel->getEarlyCount();



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
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container">
            <p class="alert alert-warning">Hello <strong><?php echo $user['fullname'];  ?></strong>, Welcome to
                your
                attendance dashboard.
            </p>
        </div>

        <!-- <hr /> -->



        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8 offset-md-2 ">
                        <!-- general form elements -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">TAKE ATTENDANCE</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- <div class="card-body" style=""> -->

                            <!-- Analog Clock -->
                            <div class="clock">
                                <div class="hour">
                                    <div class="hor" id="hor">
                                    </div>
                                </div>
                                <div class="minutes">
                                    <div class="mn" id="mn">
                                    </div>
                                </div>
                                <div class="seconds">
                                    <div class="sc" id="sc">
                                    </div>
                                </div>
                            </div>

                            <!-- Digital Clock -->
                            <div class="">
                                <div class="date">
                                    <span id="day">Day</span>,
                                    <span id="month">Month</span>
                                    <span id="num">00</span>,
                                    <span id="year">Year</span>
                                </div>
                                <div class="time">
                                    <span id="hour">00</span>:
                                    <span id="min">00</span>:
                                    <span id="sec">00</span>
                                    <span id="period">AM</span>
                                </div>
                            </div>


                            <div class="col-md-8 offset-md-2" style="margin-bottom: 30px;">
                                <?php if($count <= 0) {?>

                                <button onclick="takeAttendance()" class="btn btn-xl btn-success btn-block">Clock
                                    In</button>
                                <?php }else{ ?>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span
                                        style="height: 100px; width: 100px; border-radius: 50px;background-color:green;display:flex; justify-content:center; align-items:center;"><i
                                            class="fa fa-check" style="font-size: 30px; color:white;"></i></span>

                                </div>
                                <p class="text-center">You have already teken attendance for today!</p>
                                <p class="text-center">We'll open it to you again tomorrow. Enjoy your day!!!</p>
                                <?php } ?>
                            </div>


                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>



        <hr />


        <?php if(isset($user) && $user['role'] =='Admin'){ ?>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $staffCount; ?></h3>

                                <p>Staffs</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $earlycount; ?></h3>

                                <p>On Time</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $latecount; ?></h3>

                                <p>Late Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>

        <?php } ?>

    </div>
</div>

<?php
    include './includes/footer.php';
?>


<script>
function takeAttendance() {
    Swal.fire({
        title: 'Attendance',
        text: "Confirm To Save Your Attendance",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Proceed!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "saveattendance.php",
                method: "POST",
                data: {
                    staffid: "<?php echo $user['staffid'] ?>",
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        Swal.fire(
                            'Success',
                            res.message,
                            'success'
                        ).then((ok) => {
                            if (ok) {
                                window.location.reload();
                            }
                        }).catch((err) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'Oops something went wrong. Please try again',
                            'error'
                        )
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'Oops something went wrong. Please try again',
                        'error'
                    )
                }
            })

        } else {
            Swal.fire(
                'Cancelled',
                'Your attendance not saved',
                'error'
            )
        }
    })
}
</script>