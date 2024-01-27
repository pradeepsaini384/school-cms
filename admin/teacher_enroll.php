<?php
include('adminheader.php');
include('../db_connection.php'); // Include your database connection file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
  $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);
  $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
  $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
  $fatherName = mysqli_real_escape_string($conn, $_POST["fatherName"]);
  $status = mysqli_real_escape_string($conn, $_POST["status"]);
  $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
  if ($password != $confirmPassword) {
    echo "Password and Confirm Password do not match.";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the students table
$sql = "INSERT INTO teacher (email, password, fname, lname, dob, mobile_no, status, gender,father_name)
        VALUES ('$email', '$hashedPassword', '$firstName', '$lastName', '$dob', '$mobile', '$status', '$gender',  '$fatherName')";

if ($conn->query($sql) === TRUE) {
  $success_message= "Teacher  Enrolled successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
}

// Hash the password before storing in the database (improve security)


?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Teacher Dashboard</h1>
    <a href="teacher_detail.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-user fa-sm text-white-50"></i> Teacher List</a>
  </div>
  <div class="container-xl">
    <!-- Content Row -->
    <div class="card">
      <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Enroll New Teacher</h1>

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
      <label for="inputFirstName">First Name*</label>
      <input type="text" class="form-control" id="inputFirstName" name="firstName">
    </div>
    <div class="form-group col-md-6">
      <label for="inputLastName">Last Name*</label>
      <input type="text" class="form-control" id="inputLastName" name="lastName">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail">Email*</label>
      <input type="email" class="form-control" id="inputEmail" name="email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword">Password*</label>
      <input type="password" class="form-control" id="inputPassword" name="password">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputConfirmPassword">Confirm Password*</label>
      <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPassword">
    </div>
    <div class="form-group col-md-6">
      <label for="inputDob">Date of Birth*</label>
      <input type="date" class="form-control" id="inputDob" name="dob">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputMobile">Mobile No*</label>
      <input type="tel" class="form-control" id="inputMobile" name="mobile">
    </div>
    <div class="form-group col-md-6">
      <label for="inputFatherName">Father Name*</label>
      <input type="text" class="form-control" id="inputFatherName" name="fatherName">
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputGender">Gender*</label>
      <select class="form-control" id="inputGender" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
        <!-- Add more options as needed -->
      </select>
    </div>
   
    <div class="form-group col-md-6">
      <label for="inputStatus">Status*</label>
      <select class="form-control" id="inputStatus" name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>
  </div>


  <button type="submit" class="btn btn-primary">Add Teacher</button>
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
include('adminfooter.php');
?>