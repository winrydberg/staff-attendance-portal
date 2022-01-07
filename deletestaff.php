<?php
namespace App;

session_start();

require 'vendor/autoload.php';
// include './app/AuthCheck.php';
// include './includes/header.php';

use App\SQLiteDelete;
use App\SQLiteConnection as SQLiteConnection;




$pdo = (new SQLiteConnection())->connect();
$del = new SQLiteDelete($pdo);

if($_POST['delete']){
    $res = $del->deleteStaff($_POST['staffid']);
    if($res > 0){
        echo json_encode([
            'status' => 'success',
            'message' => 'Staff successfully removed'
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'Oops something went wrong. Please try again'
        ]);
    }
}else{
    echo json_encode([
            'status' => 'error',
            'message' => 'Oops something went wrong. Please try again'
        ]);
}