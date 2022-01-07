<?php 

session_start();

require 'vendor/autoload.php';
// include './app/AuthCheck.php';
// include './includes/header.php';

use App\SQLiteInsert;
use App\SQLiteConnection as SQLiteConnection;




$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteInsert($pdo);

if($_POST['settime']){
    $res = $sqlite->insertReportingTime($_POST['settime']);
   
        
    echo json_encode([
            'status'=>'success',
            'message' => 'Reporting Time Successfully Set To '.$_POST['settime']
    ]);
    
    
}