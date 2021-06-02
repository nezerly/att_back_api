<?php

class Student
{
    public $id;
    public $student_id;
    public $student_name;
    public $student_class;
    public $timestamp;
    private $conn;
    private $table = 'students';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET student_id = :student_id, 
                    student_name = :student_name, student_class = :student_class';


        $stmt = $this->conn->prepare($query);

        $this->student_id = htmlspecialchars($this->student_id);
        $this->student_name = htmlspecialchars($this->student_name);
        $this->student_class = htmlspecialchars($this->student_class);

        $stmt->bindParam(':student_id', $this->student_id);
        $stmt->bindParam(':student_name', $this->student_name);
        $stmt->bindParam(':student_class', $this->student_class);

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


    public function read_one()
    {

        $query = "SELECT * FROM $this->table WHERE students.id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->student_id = $row['student_id'];
        $this->student_name = $row['student_name'];
        $this->student_class = $row['student_class'];
        $this->timestamp = $row['timestamp'];

        return $stmt;

    }

}