<?php

namespace App;

/**
 * SQLite Create Table Demo
 */
class SQLiteCreateTable {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * create tables 
     */
    public function createTables() {
        $commands = ['CREATE TABLE IF NOT EXISTS staffs (
                        staffid INTEGER PRIMARY KEY AUTOINCREMENT,
                        fullname TEXT,
                        email TEXT NOT NULL,
                        phoneno TEXT,
                        department TEXT NOT NULL,
                        role TEXT,
                        password TEXT,
                        photo TEXT
                      )',

                    'CREATE TABLE IF NOT EXISTS settings (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        name  VARCHAR (255) NOT NULL,
                        value  VARCHAR (255) NOT NULL,
                        state BOOLEAN
                    )',
                    
                    'CREATE TABLE IF NOT EXISTS attendance (
                            id   INTEGER PRIMARY KEY AUTOINCREMENT,
                            staffid INTEGER,
                            entrydate TEXT,
                            entrytime TEXT,
                            marked BOOLEAN,
                            FOREIGN KEY (staffid)
                            REFERENCES staffs(staffid) ON UPDATE CASCADE ON DELETE CASCADE
                    )'
                    
                   ];
                            
        // execute the sql commands to create new tables
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }

    /**
     * get the table list in the database
     */
    public function getTableList() {

        $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }

}