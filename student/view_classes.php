<?php
include('header.php');
include('../db_connection.php');
// include('../create_tables.php');
$sessionClassId = $_SESSION['class_id'];
$classname = "SELECT name FROM class WHERE id = " . $_SESSION['class_id'];
// Assuming you have a valid database connection in $conn

// Query to retrieve course data along with teacher information
$courseQuery = "SELECT timetable.*, teacher.fname AS teacher_fname, teacher.lname AS teacher_lname, courses.name AS course_name
                FROM timetable
                LEFT JOIN teacher ON timetable.teacher_id = teacher.id
                LEFT JOIN courses ON timetable.course_id = courses.id
                WHERE timetable.class_id = $sessionClassId";


$sqlresult = $conn->query($classname);
if ($sqlresult && mysqli_num_rows($sqlresult) > 0) {
    $row = mysqli_fetch_assoc($sqlresult);
    $className = $row['name'];
} 
$result = $conn->query($courseQuery);
?>
 <div id="content-wrapper" class="d-flex flex-column">
<?php 

if ($result && mysqli_num_rows($result) > 0) {
    ?>
    <div class="container-fluid">
        <h2 class="text-center mb-4">Class Schedule</h2>
        <div class="row">
            <?php
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-3">
                    <div class="card class-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['course_name'] ?></h5>
                            <p class="card-text">Room: 101</p>
                            <p class="card-text">Time: <?= $row['start_time'] ?> </p>
                            <p class="card-text">Day: Monday </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo "No class schedule data available.";
}

?>


</div>
<?php
include('footer.php');
// include('../create_tables.php');
?>
