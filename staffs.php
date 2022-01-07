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

$staffs =  $sel->getStaffs();



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
                            <li class="breadcrumb-item"><a href="#">Staffs</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Staff Records</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($staffs as $staff){ ?>
                                        <tr>
                                            <td>
                                                <img style="height: 30px; width: 30px;"
                                                    src="./uploaded_files/<?php echo $staff['photo']; ?>" />
                                            </td>
                                            <td><?php echo $staff['fullname'];?></td>
                                            <td><?php echo $staff['email'];?></td>
                                            <td><?php echo $staff['phoneno'];?></td>
                                            <td><?php echo $staff['department'];?></td>
                                            <td><?php echo $staff['role'];?></td>
                                            <td>
                                                <button class="btn btn-xs btn-danger"
                                                    onclick="deleteStaff(<?php echo $staff['staffid'];?>)">Delete</button>
                                                <a href="staffattendance.php?staffid=<?php echo $staff['staffid']; ?>"
                                                    class="btn btn-xs btn-success">Attendance</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<?php
    include './includes/footer.php';
?>

<script>
function deleteStaff(id) {
    Swal.fire({
        title: 'Delete Staff',
        text: "Are you sure you want to delete staff",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "deletestaff.php",
                method: "POST",
                data: {
                    delete: 'delete',
                    staffid: id,
                },
                success: function(response) {
                    var res = JSON.parse(response);
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
                'Action cancelled. Staff NOT deleted',
                'error'
            )
        }
    })
}
</script>