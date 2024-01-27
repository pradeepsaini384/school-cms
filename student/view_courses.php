<?php
include('header.php');
// include('../create_tables.php');
include('../db_connection.php');
$sessionClassId = $_SESSION['class_id'];

// Assuming you have a valid database connection in $conn

// Query to retrieve course data along with teacher information
$courseQuery = "SELECT courses.*, teacher.fname AS teacher_fname,teacher.lname AS teacher_lname
                FROM courses
                LEFT JOIN teacher ON courses.teacher_id = teacher.id
                WHERE courses.class_id = $sessionClassId";

$result = $conn->query($courseQuery);


if ($result) {
    echo '<div class="container-fluid">
            <h2 class="text-center mb-4">Course Subject Details</h2>
            <div class="row">';
    
    // Fetch data and generate HTML for each subject
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6">
                <div class="card subject-card">
                    <div class="card-header">
                        <h5 class="card-title">' . $row['name'] . '</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Teacher:</strong> ' . $row['teacher_fname']." ".$row['teacher_lname'] . '</p>
                        <p><strong>Schedule:</strong> ' . "". '</p>
                        
                    </div>
                </div>
              </div>';
    }

    echo '</div></div>';
} else {
    // Handle query error if needed
    echo "Error executing query: " . $conn->error;
}
                               ?>
<?php
include('footer.php');
// include('../create_tables.php');
?>
