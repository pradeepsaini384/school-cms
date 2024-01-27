<?php
include('header.php');
include('../db_connection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = $_POST["name"];
  $section = $_POST["section"];
  $year = $_POST["year"];
  $remark = $_POST["remark"];
  $sectionStatus = $_POST["sectionStatus"];

  if (empty($name) || empty($section) || empty($year) || empty($sectionStatus)) {
    $error_message = "All fields are required. Please fill in all the information correctly.";
  } else {
    // Insert data into the users table
    $insertQuery = "INSERT INTO class (name, section,remark, year,status) VALUES ('$name', '$section','$remark', '$year','$sectionStatus')";
    if ($conn->query($insertQuery)) {
      $success_message = "Class created successfully!";
    } else {
      $error_message = "Error creating user: " . $conn->error;
    }
  }
}

?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Class Dashboard</h1>
    <a href="class_view.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-user fa-sm text-white-50"></i> class List</a>
  </div>
  <div class="container-xl">
    <!-- Content Row -->
    <div class="card">
      <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Create New class</h1>

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
              <label for="inputsection">Section*</label>
              <input type="text" class="form-control" id="inputsection" name="section">
            </div>
          </div>
          <div class="form-row text-align-center">
            <div class="form-group col-md-6  ">
              <label for="inputyear">Year*</label>
              <input type="number" class="form-control" id="inputyear" name="year">
            </div>
            <div class="form-group col-md-6  ">
              <label for="inputremark">Remark</label>
              <input type="text" class="form-control" id="inputremark" name="remark">
            </div>
           
            </div>
            <div class="form-row">
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
          </div>


          <button type="submit" class="btn btn-primary">Create Class</button>
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