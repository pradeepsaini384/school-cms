<?php
include('adminheader.php');
include('../db_connection.php'); // Include your database connection file

// Assuming you have a database connection object named $conn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $eventFor = $_POST["for"];
    $priority = $_POST["priority"];
    if ($priority == "Important") {
        $priority =1;}
    else {
        $priority = 2;
    }
    $created_by = "Principle";
    $sectionStatus = isset($_POST["sectionStatus"]) ? $_POST["sectionStatus"] : ''; // Check if the radio button is selected

    // Handle file upload
    $targetDirectory = "../uploads/"; // Set your target directory for file uploads
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
        $imagePath = $targetFile;
    } else {
        // File upload failed
        $imagePath = '/events'; // Set to an appropriate default value or handle accordingly
    }

    $description = $_POST["description"];

    if (empty($name) || empty($eventFor) || empty($priority) || empty($sectionStatus)) {
        $error_message = "All fields are required. Please fill in all the information correctly.";
    } else {
        // Insert data into the event table
        $insertQuery = "INSERT INTO event (name, event_for, priority, img, detail, status,created_by) 
                        VALUES ('$name', '$eventFor', '$priority', '$imagePath', '$description', '$sectionStatus','$created_by')";

        if ($conn->query($insertQuery)) {
            $success_message = "Event created successfully!";
        } else {
            $error_message = "Error creating event: " . $conn->error;
        }
    }
}


?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Class Dashboard</h1>
        <a href="event_view.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Event List</a>
    </div>
    <div class="container-xl">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-2 text-gray-800">Create New Event</h1>

            </div>
            <div class="card-body">

                <?php
                if (isset($success_message)) {
                    echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
                } elseif (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                }
                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name*</label>
                            <input type="text" class="form-control" id="inputName" name="name">
                        </div>



                        <div class="form-group col-md-6">
                            <label for="inputFor">For*</label>
                            <select class="form-control" id="inputFor" name="for">
                            <option value="ALL">ALL</option>
                                <option value="Teachers">Teachers</option>
                                <option value="Students">Students</option>
                                <option value="Management">Management</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="priority">Priority*</label>
                            <select class="form-control" id="priority" name="priority">
                                <option value="Important">Important</option>
                                <option value="General">General</option>

                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-auto my-1">
                            <label for="inputsection">Status*</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="activeRadio" name="sectionStatus"
                                    value="active">
                                <label class="form-check-label" for="activeRadio">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inactiveRadio" name="sectionStatus"
                                    value="inactive">
                                <label class="form-check-label" for="inactiveRadio">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputImage">Image/PDF</label>
                            <input type="file" class="form-control-file" id="inputImage" name="image">
                        </div>
                    </div>
                     <div class="form-row">
        
        <!-- Text area for description -->
        <div class="form-group col-md-12">
            <label for="inputDescription">Description</label>
            <textarea class="form-control" id="inputDescription" name="description" rows="5"></textarea>
        </div>
    </div>

                    <button type="submit" class="btn btn-primary">Create Event</button>
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