<?php
include('adminheader.php');
include('../db_connection.php'); // Include your database connection file

function getUserData($conn, $id)
{
    $selectQuery = "SELECT * FROM teacher WHERE id = '$id'";
    $result = $conn->query($selectQuery);
    // echo "hello"; die;
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userData = getUserData($conn, $id);

    if ($userData) {
        // Use $userData to pre-fill form fields
        $fname = $userData['fname'];
        $lname = $userData['lname'];
        $section = $userData['email'];
        $status = $userData['status'];
        $dob = $userData['dob'];
        $mobile_no = $userData['mobile_no'];
        $gender = $userData['gender'];
        $father_name = $userData['father_name'];

        // $role = $userData['password'];


        // You can add more fields as needed
    } else {
        // Handle case when user with the provided email is not found
        echo '<div class="alert alert-danger" role="alert">User not found for the provided email.</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editUser'])){
  // Retrieve form data
  $id = mysqli_real_escape_string($conn, $_POST["id"]);
  $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
  $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
  $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
  $fatherName = mysqli_real_escape_string($conn, $_POST["fatherName"]);
  $status = mysqli_real_escape_string($conn, $_POST["status"]);
  $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

// Insert data into the students table
$updateQuery = "UPDATE teacher 
                SET 
                    email = '$email',  
                    fname = '$firstName', 
                    lname = '$lastName', 
                    dob = '$dob', 
                    mobile_no = '$mobile', 
                    status = '$status', 
                    gender = '$gender', 
                    father_name = '$fatherName' 
                WHERE id = $id";

if ($conn->query($updateQuery)) {
    echo '<script>alert("Changes Make successfully! ");</script>';

        // Redirect to the user list page
        echo '<script>window.location.href = "teacher_edit.php?id='.$id.'";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}

}
if (isset($_POST['resetPassword'])) {
    $email = $_POST["email"];
    $id = $_POST["id"];
    $mobile = $_POST["mobile"];
    // Generate a new password based on the user's email and mobile number
    $newPassword = substr($email, 0, 4).substr($mobile, 0, 4);
    echo '<script>console.log('.$newPassword.');</script>';
    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the users table
    $updatePasswordQuery = "UPDATE teacher SET password='$hashedPassword' WHERE id='$id'";

    if ($conn->query($updatePasswordQuery)) {
        echo '<script>alert("Password reset successfully! New password: ' . $newPassword . '");</script>';

        // Redirect to the user list page
        echo '<script>window.location.href = "teacher_detail.php";</script>';
        exit; 
    } else {
        $error_message .= " Error resetting password: " . $conn->error;
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
<input type="hidden" name="id" value="<?php echo isset($userData['id']) ? htmlspecialchars($userData['id']) : ''; ?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputFirstName">First Name*</label>
            <input type="text" class="form-control" id="inputFirstName" name="firstName" value="<?php echo isset($fname) ? htmlspecialchars($fname) : ''; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="inputLastName">Last Name*</label>
            <input type="text" class="form-control" id="inputLastName" name="lastName" value="<?php echo isset($lname) ? htmlspecialchars($lname)  : ''; ?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email*</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo isset($section) ? htmlspecialchars($section) : ''; ?>">
        </div>
        
 

    
        <div class="form-group col-md-6">
            <label for="inputDob">Date of Birth*</label>
            <input type="date" class="form-control" id="inputDob" name="dob" value="<?php echo isset($dob) ? htmlspecialchars($dob) : ''; ?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputMobile">Mobile No*</label>
            <input type="tel" class="form-control" id="inputMobile" name="mobile" value="<?php echo isset($mobile_no) ? htmlspecialchars($mobile_no) : ''; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="inputFatherName">Father Name*</label>
            <input type="text" class="form-control" id="inputFatherName" name="fatherName" value="<?php echo isset($father_name) ? htmlspecialchars($father_name) : ''; ?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputGender">Gender*</label>
            <select class="form-control" id="inputGender" name="gender">
                <option value="male" <?php echo (isset($gender) && $gender === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($gender) && $gender === 'female') ? 'selected' : ''; ?>>Female</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="inputStatus">Status*</label>
            <select class="form-control" id="inputStatus" name="status">
                <option value="active" <?php echo (isset($status) && $status === 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo (isset($status) && $status === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" name="editUser" class="btn btn-primary">Edit teacher</button>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <button type="submit" name="resetPassword" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
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