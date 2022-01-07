<?php
namespace App;
session_start();
// include './app/AuthCheck.php';
require 'vendor/autoload.php';
include './includes/header.php';

use App\SQLiteConnection;



$pdo = (new SQLiteConnection())->connect();


if($_POST){
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        try{
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            try{
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], __DIR__.'uploads/'. $_FILES["fileToUpload"]['name']);
            }catch(Exception $e){
                echo $e->message;
            }
            // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //     echo "The file "; 
            //     //htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            // } else {
            //     echo "Sorry, there was an error uploading your file.";
            // }
        }
    }catch(Exception $e){
        echo $e->message;
    }
}else{

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
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">New Staff</h3>
                            </div>
                            <!-- /.card-header -->

                            <?php
                                if (isset($_SESSION['message']) && $_SESSION['message'])
                                {
                                echo '<p class="alert alert-info">'.$_SESSION['message'].'</p>';
                                unset($_SESSION['message']);
                                }
                            ?>
                            <!-- form start -->
                            <form action="./upload.php" method="POST" id="newStaff" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" name="fullname" id=fullname class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Department</label>
                                        <select class="form-control" name="department">

                                            <option value="Teaching">Teaching</option>
                                            <option value="Non Teaching">Non Teaching</option>
                                            <option value="Accounting">Accounting</option>
                                            <option value="Catering">Catering/Food </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Phone No.</label>
                                                <input type="number" name="phoneno" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Access Control Type</label>
                                        <select class="form-control" name="role">
                                            <option value="Staff">Regular Staff</option>
                                            <option value="Admin">Administrator</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="uploadedFile" onChange="img_pathUrl(this);"
                                                    class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <input type="submit" name="uploadBtn" class="btn btn-success" value="Save Staff" />

                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Photo</h3>
                            </div>
                            <div class="card-body">
                                <div class="col d-flex justify-content-center">
                                    <img src="./assets/img/avatar.png" style="object-fit:cover;" id="img_url"
                                        class="img-fluid" alt="your image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
    </div>
</div>

<script>
function img_pathUrl(input) {
    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}



$(document).ready(function() {

    // $('#newStaff').submit(function(event) {
    //     event.preventDefault();
    //     alert('hi')
    // });
})
</script>

<?php
    include './includes/footer.php';
?>