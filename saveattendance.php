<?php 

session_start();

require 'vendor/autoload.php';
// include './app/AuthCheck.php';
// include './includes/header.php';

use App\SQLiteInsert;
use App\SQLiteConnection as SQLiteConnection;




$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteInsert($pdo);

if($_POST){
    $result = $sqlite->insertAttendance($_POST['staffid']);

    echo json_encode([
        'status'=>'success',
        'data'=>$_POST['staffid'],
        'message' => "Attendance for today successfully saved"
    ]);
}