<?php
include('teacher_header.php');

include('../db_connection.php');
$sql = "SELECT * FROM exams WHERE teacher_id = " . $_SESSION["teacher_id"];

$result = mysqli_query($conn, $sql);
?>

<div class="container align-items-center">
  <!-- Content here -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-6">
        <h1 class="h3 mb-0 text-gray-800">View Exam</h1>
        <a href="create_exam.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Create Exam </a>
    </div>



</div>
<?php 
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    ?>

    <div class="container align-items-center">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Exams</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Exam Type</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Date Time</th>
                      
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Exam Type</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Date Time</th>
                             
                            </tr>
                        </tfoot>
                        <tbody>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['exam_type'] ?></td>
            <td><?= $row['class_id'] ?></td>
            <td><?= $row['section'] ?></td>
            <td><?= $row['datetime'] ?></td>

        </tr>
        <?php
    }

    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "0 results";
}

include('teacher_footer.php');
?>