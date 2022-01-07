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

$sel = new SQLiteSelect($pdo);

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
                            <li class="breadcrumb-item"><a href="#">New Staff</a></li>
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
                                <h3 class="card-title">Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-5">
                                    <form action="#" method="post" class="form-vertical">

                                        <div class="form-group">
                                            <input type="time" id="rptime" class="form-control"
                                                placeholder="Reporting Time"
                                                value="<?php echo $setting!=null?$setting['value']:"08:00"; ?>" />
                                        </div>


                                        <div class="form-group">
                                            <button type="button" onclick="setNewReportingTime()"
                                                class="btn btn-primary btn-block">
                                                Set Reporting Time
                                            </button>
                                        </div>

                                    </form>
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


<script>
function setNewReportingTime() {
    var time = $('#rptime').val();
    Swal.fire({
        title: 'Set Reporting Time',
        text: "Confirm to Set a New Reporting Time",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reset!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "savesettings.php",
                method: "POST",
                data: {
                    settime: time,
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    // console.log(response);
                    if (res.status == 'success') {

                        Swal.fire(
                            'Success',
                            res.message,
                            'success'
                        )

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
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
                'Action cancelled. Time NOT set',
                'error'
            )
        }
    })
}
</script>