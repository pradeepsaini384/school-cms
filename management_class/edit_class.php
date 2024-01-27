<?php
include('header.php');
include('../db_connection.php'); // Include your database connection file
function getUserData($conn, $id)
{
    $selectQuery = "SELECT * FROM class WHERE id = '$id'";
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
        $section = $userData['section'];
        $sectionStatus = $userData['status'];
        $year = $userData['year'];
        $remark = $userData['remark'];
        // $role = $userData['password'];


        // You can add more fields as needed
    } else {
        // Handle case when user with the provided email is not found
        echo '<div class="alert alert-danger" role="alert">User not found for the provided email.</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $id = $_POST["id"];
    $section = $_POST["section"];
    $year = $_POST["year"];
    $remark = $_POST["remark"];
    $sectionStatus = $_POST["sectionStatus"];

    if (empty($name) || empty($section) || empty($year) || empty($sectionStatus)) {
        $error_message = "All fields are required. Please fill in all the information correctly.";
    } else {
        // Insert data into the users table
        $updateQuery = "UPDATE class SET name='$name', section='$section', remark='$remark', year='$year', status='$sectionStatus' WHERE id='$id'";
        if ($conn->query($updateQuery)) {
            $success_message = "Class edited successfully!";
        } else {
            $error_message = "Error creating user: " . $conn->error;
        }
    }
}

?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Class Dashboard</h1>
        <a href="view_class.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> class List</a>
    </div>
    <div class="container-xl">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-2 text-gray-800">Update class</h1>

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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name*</label>
                            <input type="text" class="form-control" id="inputName" name="name"
                                value="<?php echo isset($name) ? $name : ''; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputsection">Section*</label>
                            <input type="text" class="form-control" id="inputsection"
                                value="<?php echo isset($section) ? $section : ''; ?>" name="section">
                        </div>
                    </div>
                    <div class="form-row text-align-center">
                        <div class="form-group col-md-6  ">
                            <label for="inputyear">Year*</label>
                            <input type="number" class="form-control" id="inputyear"
                                value="<?php echo isset($year) ? $year : ''; ?>" name="year">
                        </div>
                        <div class="form-group col-md-6  ">
                            <label for="inputremark">Remark</label>
                            <input type="text" class="form-control" id="inputremark"
                                value="<?php echo isset($remark) ? $remark : ''; ?>" name="remark">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-auto my-1">
                            <label for="inputsection">Status*</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="activeRadio" name="sectionStatus"
                                    value="active" <?php echo ($sectionStatus === "active") ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="activeRadio">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inactiveRadio" name="sectionStatus"
                                    value="inactive" <?php echo ($sectionStatus === "inactive") ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="inactiveRadio">Inactive</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Class</button>
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