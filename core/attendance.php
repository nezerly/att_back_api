<?php

class Attendance
{
    public $id;
    public $barcode_event;
    public $day_date;
    public $student_id;
    public $timestamp;
    private $conn;
    private $table = 'attendances';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET barcode_event = :barcode_event, day_date = :day_date, 
        student_id = :student_id, student_name = :student_name, student_class = :student_class';


        $stmt = $this->conn->prepare($query);

        $this->barcode_event = htmlspecialchars($this->barcode_event);
        $this->day_date = htmlspecialchars(date("Y-m-d"));
        $this->student_id = htmlspecialchars($this->student_id);

        $stmt->bindParam(':barcode_event', $this->barcode_event);
        $stmt->bindParam(':day_date', $this->day_date);
        $stmt->bindParam(':student_id', $this->student_id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s. \n", $stmt->error);
        return false;

    }

    public function count_all()
    {
        $result = $this->read();

        return $result->rowCount();
    }

    public function read()
    {

        $query = "SELECT * FROM $this->table";

//        return $query;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function count()
    {
        $result = $this->allScanByStudents();

        return $result->rowCount();
    }

    public function allScanByStudents()
    {
        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances AS a ON a.student_id = s.student_id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function scanByStudent()
    {

//        $query = "SELECT s.student_id, s.student_name, s.created_at,
//                    a.barcode_event, a.day_date, a.student_id,
//                    a.timestamp FROM students AS s JOIN attendances
//                    AS a ON a.student_id = s.student_id WHERE a.student_id = '700507'";

        $query = "SELECT s.student_id, s.student_name, s.created_at, s.student_class,\n"

            . "                    a.barcode_event, a.day_date, a.student_id, \n"

            . "                    a.timestamp FROM students AS s JOIN attendances \n"

            . "                    AS a ON a.student_id = s.student_id WHERE a.student_id = ?";

//        return $query;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->student_id);


        $stmt->execute();

        return $stmt;

    }

    public function countByIndex()
    {
        $result = $this->readByIndex();

        return $result->rowCount();
    }

    /**
     * @return mixed
     */
    public function readByIndex()
    {

        $query = "SELECT * FROM $this->table WHERE phprest.attendances.student_id = ?";

//        return $query;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->student_id);


        $stmt->execute();

        return $stmt;

    }

    public function countByDate()
    {
        $result = $this->readByDate();

        return $result->rowCount();
    }

    public function readByDate()
    {

        $query = "SELECT * FROM $this->table WHERE attendances.day_date = ?";

//        return $query;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->day_date);


        $stmt->execute();

        return $stmt;

    }

    public function readAllVision()
    {

        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances 
                    AS a ON a.student_id = s.student_id WHERE a.barcode_event LIKE '%VISION%'";

//        return $query;
        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;

    }

    public function readAllPillar()
    {

        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances 
                        AS a ON a.student_id = s.student_id WHERE a.barcode_event LIKE '%VISION%'";

        //        return $query;
        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;

    }

    public function readAllBMCDR()
    {

        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances 
                        AS a ON a.student_id = s.student_id WHERE a.barcode_event LIKE '%BMCDR%'";

        //        return $query;
        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;

    }

    public function readTodayVision()
    {

        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances AS a 
                    ON a.student_id = s.student_id WHERE a.barcode_event LIKE '%PILLAR%' AND a.day_date = ?";

//        return $query;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->day_date);


        $stmt->execute();

        return $stmt;

    }

    public function readTodayPillar()
    {

        $query = "SELECT s.*, a.* FROM students AS s JOIN attendances AS a 
                    ON a.student_id = s.student_id WHERE a.barcode_event LIKE '%PILLAR%' AND a.day_date = ?";

//        return $query;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->day_date);


        $stmt->execute();

        return $stmt;

    }

    public function read_one()
    {

        $query = "SELECT * FROM $this->table WHERE attendances.id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->barcode_event = $row['barcode_event'];
        $this->day_date = $row['day_date'];
        $this->student_id = $row['student_id'];
        $this->timestamp = $row['timestamp'];

        return $stmt;

    }

}