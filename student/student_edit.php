<?php
include('header.php');
include('../db_connection.php');
$sql = "SELECT students.*, class.name AS class_name, class.section AS class_section, 
class.year AS class_year, class.remark AS class_remark
FROM students
LEFT JOIN class ON students.class_id = class.id
WHERE students.id = " . $_SESSION["student_id"];
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $studentData = mysqli_fetch_assoc($result);
}
// include('../create_tables.php');
?>
      <!-- Begin Page Content -->
      <div class="container-fluid">
                    <div class="card profile-card">
                        <div class="card-header">
                            <h4>Student Profile</h4>
                        </div>
                        <div class="card-body">
                            <form>
                            <div class="form-group">
                    <label for="profileName">Profile Name</label>
                    <input type="text" class="form-control" id="profileName" placeholder="Enter profile name" value="<?= $studentData["fname"] ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fatherName">Father's Name</label>
                        <input type="text" class="form-control" id="fatherName" placeholder="Enter father's name" value="<?= $studentData["father_name"] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="motherName">Mother's Name</label>
                        <input type="text" class="form-control" id="motherName" placeholder="Enter mother's name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="joiningDate">Joining Date</label>
                    <input type="text" class="form-control" id="joiningDate" placeholder="Enter joining date" value="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="currentClass">Current Class</label>
                        <input type="text" class="form-control" id="currentClass" placeholder="Enter current class" value="<?= $studentData["class_name"] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" placeholder="Enter year" value="<?= $studentData["class_year"] ?>">
                    </div>
                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="hostel">Hostel</label>
                                        <select class="form-control" id="hostel">
                                            <option >Yes</option>
                                            <option selected>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="busService">Bus Service</label>
                                        <select class="form-control" id="busService">
                                            <option >Yes</option>
                                            <option selected>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aadharNumber">Aadhar Card Number</label>
                                    <input type="text" class="form-control" id="aadharNumber" placeholder="Enter Aadhar Card number">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="mobileNumber">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobileNumber" placeholder="Enter mobile number" value="<?= $studentData["mobile_no"] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?= $studentData["email"] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" class="form-control" id="dob" placeholder="Enter date of birth" value="<?= $studentData["dob"] ?>">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="rollNumber">Roll Number</label>
                                        <input type="text" class="form-control" id="rollNumber" placeholder="Enter roll number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="personalNumber">Personal Number</label>
                                        <input type="text" class="form-control" id="personalNumber" placeholder="Enter personal number">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fatherNumber">Father's Number</label>
                                        <input type="text" class="form-control" id="fatherNumber" placeholder="Enter father's number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feeStatus">Fee Status</label>
                                        <select class="form-control" id="feeStatus">
                                            <option selected>Paid</option>
                                            <option>Unpaid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="performance">Performance</label>
                                    <input type="text" class="form-control" id="performance" placeholder="Enter performance">
                                </div>
                                <button type="button" class="btn btn-primary edit-btn">Edit Profile</button>
                            </form>
                        </div>
                    </div>
                    </div>
                <!-- /.container-fluid -->
<?php
include('footer.php');
// include('../create_tables.php');
?>
