<?php
include('header.php');
include('../db_connection.php'); // Include your database connection file

$classQuery = "SELECT id, name FROM class";
$classResult = mysqli_query($conn, $classQuery);

// Fetch teacher data
$teacherQuery = "SELECT id, fname ,lname FROM teacher";
$teacherResult = mysqli_query($conn, $teacherQuery);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = $_POST["name"];
  $class = $_POST["class"];
  $teacher = $_POST["teacher"];
 

  if (empty($name) || empty($class) || empty($teacher) ) {
    $error_message = "All fields are required. Please fill in all the information correctly.";
  } else {
    // Insert data into the users table
    $insertQuery = "INSERT INTO courses (name, class_id,teacher_id) VALUES ('$name', '$class','$teacher')";
    if ($conn->query($insertQuery)) {
      $success_message = "Course created successfully!";
    } else {
      $error_message = "Error creating user: " . $conn->error;
    }
  }
}

?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Course Dashboard</h1>
    <a href="view_course.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-user fa-sm text-white-50"></i> Courses List</a>
  </div>
  <div class="container-xl">
    <!-- Content Row -->
    <div class="card">
      <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Create New Course</h1>

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
              <label for="inputName">Name*</label>
              <input type="text" class="form-control" id="inputName" name="name">
            </div>
            <div class="form-group col-md-6">
            <label for="inputclass">Class*</label>
            <select class="form-control" id="inputclass" name="class">
                <?php
                // Populate class options
                while ($classRow = mysqli_fetch_assoc($classResult)) {
                    echo "<option value='{$classRow['id']}'>{$classRow['name']}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputteacher">Teacher</label>
            <select class="form-control" id="inputteacher" name="teacher">
                <?php
                // Populate teacher options
                while ($teacherRow = mysqli_fetch_assoc($teacherResult)) {
                    echo "<option value='{$teacherRow['id']}'>{$teacherRow['fname']} {$teacherRow['lname']}</option>";
                }
                ?>
            </select>
        </div>
           
            </div>
            <!-- <div class="form-row">
            <div class="form-group col-md-6 col-auto my-1">
              <label for="inputsection">Status*</label>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="activeRadio" name="sectionStatus" value="active">
                <label class="form-check-label" for="activeRadio">Active</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="inactiveRadio" name="sectionStatus" value="inactive">
                <label class="form-check-label" for="inactiveRadio">Inactive</label>
              </div>
            </div>
          </div> -->


          <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("inputpasswordc").addEventListener("input", validatePassword);
  });

  function validatePassword() {
    var password = document.getElementById("inputpassword").value;
    var confirmPassword = document.getElementById("inputpasswordc").value;

    var validationMessage = document.getElementById("password-validation-message");

    if (password === confirmPassword) {
      validationMessage.innerHTML = "Passwords match!";
      validationMessage.style.color = "green";
    } else {
      validationMessage.innerHTML = "Passwords do not match!";
      validationMessage.style.color = "red";
    }
  }
</script>
<?php
include('footer.php');
?>