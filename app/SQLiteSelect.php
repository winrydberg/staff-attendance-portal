<?php

namespace App;

/**
 * PHP SQLite Insert Demo
 */
class SQLiteSelect {


    private $pdo;


    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function getStaffCount() {
        $query=$this->pdo->query("SELECT COUNT(*) as count FROM `staffs`");
        $row=$query->fetch();
        $count=$row['count'];
        return $count;
    }

    // public function getStudentCount(){
    //     $query=$this->pdo->query("SELECT COUNT(*) as count FROM `students`");
    //     $row=$query->fetch();
    //     $count=$row['count'];
    //     return $count;
    // }


    public function getStaffs(){
        $query=$this->pdo->query("SELECT * FROM `staffs` ORDER BY fullname ASC");
        $staffs = [];
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
           
            $staffs[] = [
                'staffid' => $row['staffid'],
                'fullname' => $row['fullname'],
                'email' => $row['email'],
                'department' => $row['department'],
                'phoneno' => $row['phoneno'],
                'photo' => $row['photo'],
                'role' => $row['role']
            ];
        }
        return $staffs;
    }


    public function getAttendance($date){
        // $d = date_format($date,"Y-m-d");
        $query=$this->pdo->query("SELECT * FROM `attendance` WHERE entrydate='".$date."' ORDER BY entrytime ASC");
        $attendance = [];
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
             
            $q=$this->pdo->query("SELECT * FROM `staffs` WHERE staffid=".$row['staffid']."");

            $staff = $q->fetch();

            $attendance[] = [
                'staff' => $staff,
                'staffid' => $row['staffid'],
                'entrydate' => $row['entrydate'],
                'entrytime' => $row['entrytime'],
                'marked' => $row['marked']
            ];
        }
        return $attendance;
    }


    public function getStaff($id){
        $q=$this->pdo->query("SELECT * FROM `staffs` WHERE staffid=".$id."");
        $staff = $q->fetch();
        return $staff;
    }


    public function getStaffAttendance($date1, $date2){
        $query=$this->pdo->query("SELECT * FROM `attendance` WHERE entrydate>='".$date1."' AND entrydate<='".$date2."' ORDER BY entrydate DESC");
        $attendance = [];
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $attendance[] = [
                'staffid' => $row['staffid'],
                'entrydate' => $row['entrydate'],
                'entrytime' => $row['entrytime'],
                'marked' => $row['marked']
            ];
        }
        return $attendance;
    }


    public function getSettings(){
        // $d = date_format($date,"Y-m-d");
        $query=$this->pdo->query("SELECT * FROM settings LIMIT 1");
        $setting = $query->fetch();
        return $setting;
    }


    public function getTodayAttendance($staffid, $date){
        $query=$this->pdo->query("SELECT COUNT(*) as count FROM attendance WHERE entrydate='".$date."' AND staffid=".$staffid."");
        $todayentry = $query->fetch();

        // return $todayentry;
        $count=$todayentry['count'];
        return $count;
    }


    public function getLateCount(){
        $setting = $this->getSettings();
        $query=$this->pdo->query("SELECT COUNT(*) as count FROM attendance WHERE entrydate='".date('Y-m-d')."' AND entrytime > '".$setting['value']."'");
        $lateToday = $query->fetch();
        $count=$lateToday['count'];
        return $count;
    }

    public function getEarlyCount(){
        $setting = $this->getSettings();
        $query=$this->pdo->query("SELECT COUNT(*) as count FROM attendance WHERE entrydate='".date('Y-m-d')."' AND entrytime <= '".$setting['value']."'");
        $lateToday = $query->fetch();
        $count=$lateToday['count'];
        return $count;
    }




}