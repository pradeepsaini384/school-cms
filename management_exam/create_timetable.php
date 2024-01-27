<?php
include('header.php');
include('../db_connection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $courseId = $_POST["course"];
  $classId = $_POST["class"];
  $teacherId = $_POST["teacher"];
  $datetime = $_POST["datetime"];
  // Other fields...

  // Insert data into the timetable table
  $insertQuery = "INSERT INTO timetable (course_id, class_id, teacher_id, start_time) VALUES ('$courseId', '$classId', '$teacherId', '$datetime')";
  if ($conn->query($insertQuery)) {
    $success_message = "Timetable entry created successfully!";
  } else {
    $error_message = "Error creating timetable entry: " . $conn->error;
  }
}

// Fetch data for dynamic select options
$coursesQuery = "SELECT id, name FROM courses";
$resultCourses = $conn->query($coursesQuery);

$classesQuery = "SELECT id, name FROM class";
$resultClasses = $conn->query($classesQuery);

$teachersQuery = "SELECT id, fname,lname FROM teacher";
$resultTeachers = $conn->query($teachersQuery);
?>

<div class="container-fluid">
  <!-- Content here -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-6">
    <h1 class="h3 mb-0 text-gray-800">Time Schedule Dashboard</h1>
    <a href="class_view.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-user fa-sm text-white-50"></i> Time Table</a>
  </div>
  <div class="container-xl">
    <!-- Content Row -->
    <div class="card">
      <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Create New Timetable Entry</h1>
      </div>
      <div class="card-body">

        <?php
        if (isset($success_message)) {
          echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
        } elseif (isset($error_message)) {
          echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCourse">Course*</label>
              <select class="form-control" id="inputCourse" name="course">
                <?php while ($row = $resultCourses->fetch_assoc()) : ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputClass">Class*</label>
              <select class="form-control" id="inputClass" name="class">
                <?php while ($row = $resultClasses->fetch_assoc()) : ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputTeacher">Teacher*</label>
              <select class="form-control" id="inputTeacher" name="teacher">
                <?php while ($row = $resultTeachers->fetch_assoc()) : ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'].' '.$row['lname']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="inputRemark">Remark</label>
              <input type="text" class="form-control" id="inputRemark" name="datetime">
            </div>
            <div class="form-group col-md-3">
              <label for="inputDatetime">Datetime*</label>
              <input type="datetime-local" class="form-control" id="inputDatetime" name="datetime">
            </div>
          </div>
          <!-- Other fields... -->
          <button type="submit" class="btn btn-primary">Create Timetable Entry</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>

