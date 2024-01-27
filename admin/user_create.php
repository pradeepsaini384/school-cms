<?php
include('adminheader.php');
include('../db_connection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $role = $_POST["role"];
    $password = $_POST["inputpassword"];
   
    if (empty($name) || empty($email) || empty($mobile) || empty($role) || empty($password)) {
        $error_message = "All fields are required. Please fill in all the information correctly.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Insert data into the users table
    $insertQuery = "INSERT INTO users (name, email, mobile_no, password, role) VALUES ('$name', '$email', '$mobile','$hashedPassword', '$role')";
    if ($conn->query($insertQuery)) {
        $success_message = "User created successfully!";
    } else {
        $error_message = "Error creating user: " . $conn->error;
    }
}}

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
                <h1 class="h3 mb-2 text-gray-800">Create New User</h1>
                
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
                            <label for="inputEmail4">Email*</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputmobileno">Mobile No*</label>
                        <input type="tel" class="form-control" id="inputmobileno" name="mobile">
                    </div>
                    <div class="form-group">
                        <label for="inputrole">Role*</label>
                        <select class="form-control" id="inputrole" name="role">
                            <option value="sub_admin">Sub Admin</option>
                            <option value="ExamManager">Exam Manager</option>
                            <option value="classManager">Class Manager</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputpassword">Password*</label>
                        <input type="password" class="form-control" id="inputpassword" name="inputpassword">
                    </div>
                    <div class="form-group">
                        <label for="inputpassword">Re-Enter Password*</label>
                        <input type="password" class="form-control" id="inputpasswordc" name="inputpasswordc">
                        <span id="password-validation-message"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
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
