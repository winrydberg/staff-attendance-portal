<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();



if($_POST['login']){
    if ($pdo != null){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query=$pdo->query("SELECT COUNT(*) as count FROM `staffs` WHERE `email`='$email' AND `password`='$password'");
        
        $row=$query->fetch();
        $count=$row['count'];
        if($count > 0){
            $query=$pdo->query("SELECT * FROM `staffs` WHERE `email`='$email' AND `password`='$password' LIMIT 1");
            $data=$query->fetch();
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $data;
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $data['fullname'];
            echo json_encode([
                'status'=>'success',
                'data' => $data,
                'message' => 'Login Successful. Redirecting...'
            ]);
            
        
        }else{
            echo json_encode([
                'status'=>'error',
                'message' => 'Invalid Login Credentials'
            ]);
        }
    }else{

        $_SESSION['error'] = 'Whoops, could not connect to the SQLite database!';
    }  
}else{
    echo json_encode([
        'status'=>'error',
        'message' => 'Method NOT Allowed'
    ]);
}