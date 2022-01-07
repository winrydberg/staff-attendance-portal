<?php
namespace App;


class SQLiteInsert {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Insert a new staff into the staffs table
     */
    public function insertStaff($fullname, $email, $phoneno, $department,$role, $password, $photo ) {
        $sql = 'INSERT INTO staffs(fullname, email, phoneno, department,role,password,photo) VALUES(:fullname, :email, :phoneno, :department, :role,:password, :photo)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':fullname', $fullname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phoneno', $phoneno);
        $stmt->bindValue(':department', $department);
        $stmt->bindValue(':role', $role);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':photo', $photo);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Insert a new attendance of staff
     */
    public function insertAttendance($staffid) {
        $sql = 'INSERT INTO attendance(staffid,entrydate,entrytime,marked) '
                . 'VALUES(:staffid,:entrydate,:entrytime,:marked)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':staffid', $staffid);
        $stmt->bindValue(':entrydate',date("Y-m-d"));
        $stmt->bindValue(':entrytime',date("H:i:s"));
        $stmt->bindValue(':marked', true);
        $stmt->execute();
       
        return $this->pdo->lastInsertId();
    }


    public function insertReportingTime($time){
        //delet all inserts for reporting time
        $sql = 'DELETE FROM settings';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        //insert a new record
        $sql2 = 'INSERT INTO settings(name,value,state)'
                . 'VALUES(:name,:value,:state)';
        $stmt = $this->pdo->prepare($sql2);
        $stmt->bindValue(':name', "Reporting Time");
        $stmt->bindValue(':value',$time);
        $stmt->bindValue(':state',true);
        $stmt->execute();
       
        return $this->pdo->lastInsertId();

    }


}