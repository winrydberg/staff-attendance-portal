<?php
namespace App;

session_start();

require 'vendor/autoload.php';
// include './app/AuthCheck.php';
// include './includes/header.php';

use App\SQLiteInsert;
use App\SQLiteConnection as SQLiteConnection;




$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteInsert($pdo);



$message = '';
$hasError = '0';
$newFileName = 'avatar.png';

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Save Staff')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        
       
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}else{
    $message = 'No Files Uploaded';
}


//now create record in DB

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$password = $_POST['password'];
$department = $_POST['department'];
$role = $_POST['role'];

try{
    $result = $sqlite->insertStaff($fullname, $email, $phoneno,$department,$role,$password,$newFileName);
    if($result>0){
        $message = 'Staff successfully saved';
    }else{
        $message = 'Oops something went wrong. Please try again';
    }

}catch(\Exception $e){
    $message = 'Oops something went wrong.Unable to save staff Please try again';
}


$_SESSION['message'] = $message;
header("Location: newstaff.php");