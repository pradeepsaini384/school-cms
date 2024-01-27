<?php

require_once('db_connection.php');

// SQL query to create the users table if it doesn't exist
$tableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    role VARCHAR(50) NOT NULL
)";
$tableQueryClass = "CREATE TABLE IF NOT EXISTS class (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    section VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    remark TEXT
)";
$tableQueryStudent = "CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    father_no VARCHAR(15) NOT NULL,
    status VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    current_year INT NOT NULL,
    extra TEXT
    class_id INT, -- Assuming class_id is related to another table
)";
$tableQueryTeacher = "CREATE TABLE IF NOT EXISTS teacher (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    father_name VARCHAR(255) NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    status VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    extra TEXT -- Assuming class_id is related to another table
)";
$tableQueryevent = "CREATE TABLE IF NOT EXISTS event (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    date TIMESTAMP NOT NULL,
    event_for VARCHAR(255) NOT NULL,
    created_by VARCHAR(255) NOT NULL,
    priority INT NOT NULL,
    img VARCHAR(255), status VARCHAR(50) NOT NULL,-- You may adjust the data type based on your specific needs
    detail TEXT
)";

$tableQueryTimetable = "CREATE TABLE IF NOT EXISTS timetable (
    id INT PRIMARY KEY AUTO_INCREMENT,
    class_id INT NOT NULL,
    teacher_id INT NOT NULL,
    start_time TIME NOT NULL,
    course_id INT NOT NULL,
    remarks TEXT,
    FOREIGN KEY (class_id) REFERENCES class(id),
    FOREIGN KEY (teacher_id) REFERENCES teacher(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
)";
$tableQueryCourse = "CREATE TABLE IF NOT EXISTS courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    class VARCHAR(255) NOT NULL,
    teacher_id INT NOT NULL,
    FOREIGN KEY (teacher_id) REFERENCES teacher(id)
)";
$tableQueryExam = "CREATE TABLE IF NOT EXISTS exams (
    exam_id INT PRIMARY KEY AUTO_INCREMENT,
    exam_type VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    class_id INT,
    section VARCHAR(255) NOT NULL,
    datetime DATETIME NOT NULL,
    teacher_id INT,
    FOREIGN KEY (class_id) REFERENCES courses(id),
    FOREIGN KEY (teacher_id) REFERENCES teacher(id)
)";


if ($conn->query($tableQueryExam) === TRUE) {
    echo "Table 'teacher' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


?>
