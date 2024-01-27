<?php
include('adminheader.php');
include('../db_connection.php'); // Include your database connection file

// Function to fetch user data based on email
function getUserData($conn, $id)
{
    $selectQuery = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($selectQuery);
    // echo "hello"; die;
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Check if email is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userData = getUserData($conn, $id);

    if ($userData) {
        // Use $userData to pre-fill form fields
        $name = $userData['name'];
        $email = $userData['email'];
        $mobile = $userData['mobile_no'];
        $role = $userData['role'];
        // $role = $userData['password'];


        // You can add more fields as needed
    } else {
        // Handle case when user with the provided email is not found
        echo '<div class="alert alert-danger" role="alert">User not found for the provided email.</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Edit User" button is clicked
    if (isset($_POST['editUser'])) {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $role = $_POST["role"];
        // Update data in the users table
        $updateQuery = "UPDATE users SET name='$name', mobile_no='$mobile', role='$role' WHERE email='$email'";

        if ($conn->query($updateQuery)) {
            $success_message = "User updated successfully!";
        } else {
            $error_message = "Error updating user: " . $conn->error;
        }
    }

    // Check if the "Reset Password" button is clicked
    if (isset($_POST['resetPassword'])) {
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        // Generate a new password based on the user's email and mobile number
        $newPassword = substr($email, 0, 4).substr($mobile, 0, 4);
        echo '<script>console.log('.$newPassword.');</script>';
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the users table
        $updatePasswordQuery = "UPDATE users SET password='$hashedPassword' WHERE email='$email'";

        if ($conn->query($updatePasswordQuery)) {
            echo '<script>alert("Password reset successfully! New password: ' . $newPassword . '");</script>';

            // Redirect to the user list page
            echo '<script>window.location.href = "user_view.php";</script>';
            exit; 
        } else {
            $error_message .= " Error resetting password: " . $conn->error;
        }
    }
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">User Dashboard</h1>
        <a href="user_view.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Users List</a>
    </div>
    <div class="container-xl">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
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
                            <input type="text" class="form-control" id="inputName" name="name"
                                value="<?php echo isset($name) ? $name : ''; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email*</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email"
                                value="<?php echo isset($email) ? $email : ''; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputmobileno">Mobile No*</label>
                        <input type="tel" class="form-control" id="inputmobileno" name="mobile"
                            value="<?php echo isset($mobile) ? $mobile : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputrole">Role*</label>
                        <select class="form-control" id="inputrole" name="role">
                            <option value="sub_admin" <?php echo isset($role) && $role === 'super' ? 'selected' : ''; ?>>Super Admin</option>
                            <option value="sub_admin" <?php echo isset($role) && $role === 'sub_admin' ? 'selected' : ''; ?>>Sub Admin</option>
                            <option value="ExamManager" <?php echo isset($role) && $role === 'ExamManager' ? 'selected' : ''; ?>>Exam Manager</option>
                            <option value="classManager" <?php echo isset($role) && $role === 'classManager' ? 'selected' : ''; ?>>Class Manager</option>
                            <option value="teacher" <?php echo isset($role) && $role === 'teacher' ? 'selected' : ''; ?>>
                                Teacher</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" name="editUser" class="btn btn-primary">Edit User</button>
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