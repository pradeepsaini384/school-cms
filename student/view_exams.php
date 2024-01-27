<?php
include('header.php');
include('../db_connection.php');
// include('../create_tables.php');
$getExamsQuery = "SELECT exams.*, teacher.fname AS teacher_fname,teacher.lname AS teacher_lname, class.name AS class_name, class.section
                  FROM exams
                  LEFT JOIN teacher ON exams.teacher_id = teacher.id
                  LEFT JOIN class ON exams.class_id = class.id";

$result = $conn->query($getExamsQuery);


?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <h2 class="text-center mb-4">Exam Details</h2>
    <div class="row">

        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-md-6">
                <div class="card exam-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?> Exam</h5>
                        <p class="card-text"><strong>Exam Type:</strong> <?php echo htmlspecialchars($row['exam_type']); ?></p>
                        <p class="card-text"><strong>Date:</strong> <?php echo htmlspecialchars($row['datetime']); ?></p>
                        <!-- <p class="card-text"><strong>Time:</strong> <?php echo htmlspecialchars($row['time']); ?></p> -->
                        <p class="card-text"><strong>Teacher:</strong> <?php echo htmlspecialchars($row['teacher_fname'])." ".htmlspecialchars($row['teacher_lname']); ?></p>
                        <p class="card-text"><strong>Room Number:</strong>101</p>
                        <p class="card-text"><strong>Batch Number:</strong> <?php echo htmlspecialchars($row['section']); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

<?php
include('footer.php');
// include('../create_tables.php');
?>
