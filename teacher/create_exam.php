<?php
include('teacher_header.php');
include('../db_connection.php'); // Include your database connection file
$getUsersQuery = "SELECT * FROM class";
$result = $conn->query($getUsersQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $examType = $_POST["examType"];
    $class = $_POST["class"];
    $section = $_POST["section"];
    $datetime = $_POST["datetime"];
    $teacherid = $_SESSION["teacher_id"];
   
    if (empty($name) || empty($examType) || empty($class) || empty($section) || empty($datetime)|| empty($teacherid)) {
        $error_message = "All fields are required. Please fill in all the information correctly.";
    } else {
    // Insert data into the users table
    $insertQuery = "INSERT INTO exams (name, exam_type, class_id, teacher_id, datetime,section) VALUES ('$name', '$examType', '$class','$teacherid','$datetime', '$section')";
    if ($conn->query($insertQuery)) {
        $success_message = "Exams  created successfully!";
    } else {
        $error_message = "Error creating user: " . $conn->error;
    }
}}

?>

<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 ">Exam Creation </h1>
                        <a href="view_exam.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-user fa-sm text-white-50"></i> Exams List</a>
                    </div>
    <div class="container-xl">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-2 text-gray-800">Create New Exam</h1>
                
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
    <label for="inputExamType">Exam Type*</label>
    <select class="form-control" id="inputExamType" name="examType">
        <option value="main">Main</option>
        <option value="half_yearly">Half Yearly</option>
        <option value="1st_mid_term">1st Mid Term</option>
        <option value="2nd_mid_term">2nd Mid Term</option>
        <option value="3rd_mid_term">3rd Mid Term</option>
        
        <!-- Add more options as needed -->
    </select>
</div>

    </div>
    <?php 
    if ($result->num_rows > 0) {
        // Create a select dropdown
        echo '<div class="form-group">';
        echo '<label for="inputclass">Class*</label>';
        echo '<select class="form-control" id="inputclass" name="class">';
    
        // Iterate through each row and create an option for the select dropdown
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    
        echo '</select>';
        echo '</div>';
    }
    ?>
    <div class="form-group">
        <label for="inputSection">Section*</label>
        <input type="text" class="form-control" id="inputSection" name="section">
    </div>
    <div class="form-group">
        <label for="inputDatetime">Datetime*</label>
        <input type="datetime-local" class="form-control" id="inputDatetime" name="datetime">
    </div>
   
    <button type="submit" class="btn btn-primary">Create Exam</button>
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
include('teacher_footer.php');
?>
