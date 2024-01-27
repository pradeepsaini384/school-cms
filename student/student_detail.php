<?php
include('header.php');
// include('../create_tables.php');
include('../db_connection.php');
$sql = "SELECT students.*, class.name AS class_name, class.section AS class_section, 
class.year AS class_year, class.remark AS class_remark
FROM students
LEFT JOIN class ON students.class_id = class.id
WHERE students.id = " . $_SESSION["student_id"];

;
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $studentData = mysqli_fetch_assoc($result);
}
?>
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 "></h1>
        <a href="student_edit.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Edit Data</a>
    </div>
<div class="card text-center">
    <div class="card-header">Student detail</div>
    <div class="card-body">
        <h5 class="card-title">View Student Details</h5>
        <!-- <p class="card-text-">With supporting text below as a natural lead-in to additional content.</p> -->
        <div class=container pt-6>
        <div class="text-left">
            <p class="card-text"><strong>Profile Name:</strong>
                <?= $studentData["fname"] . ' ' . $studentData["lname"] ?>
            </p>
            <p class="card-text"><strong>Father's Name:</strong>
                <?= $studentData["father_name"] ?>
            </p>
            <p class="card-text"><strong>Mobile Number:</strong>
                <?= $studentData["mobile_no"] ?>
            </p>
            <p class="card-text"><strong>Gender:</strong>
                <?= $studentData["gender"] ?>
            </p>
            <p class="card-text"><strong>Father's Number:</strong>
                <?= $studentData["father_no"] ?>
            </p>
            <p class="card-text"><strong>Current Class:</strong>
                <?= $studentData["class_name"] ?>
            </p>
            <p class="card-text"><strong>Section:</strong>
                <?= $studentData["class_section"] ?>
            </p>
            <p class="card-text"><strong>Year:</strong>
                <?= $studentData["class_year"] ?>
            </p>
            <!-- Add more fields as needed -->
        </div>
        </div>
    </div>
    <div class="card-footer text-muted">2 days ago</div>
</div>
</div>
<?php
include('footer.php');
// include('../create_tables.php');
?>