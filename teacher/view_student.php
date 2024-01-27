<?php
include('teacher_header.php');

include('../db_connection.php');
$getUsersQuery = "SELECT * FROM students";
$result = $conn->query($getUsersQuery);

?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Classes List</h1>
        <a href="class_create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Create Class</a>
    </div>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Users List</h1> -->
    <!-- <p class="mb-4"> <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">All Classes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Father number</th>
                            <th>Dob</th>
                            <th>Gender</th>
                           
                            <th>Class</th>
                            <th>Section</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Father number</th>
                            <th>Dob</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Section</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        // Loop through each row in the result set and display user data
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["fname"] . " " . $row["lname"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["father_name"] . "</td>";
                            echo "<td>" . $row["mobile_no"] . "</td>";
                            echo "<td>" . $row["father_no"] . "</td>";
                            echo "<td>" . $row["dob"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>". $row["class_id"] . "</td>";
                            echo "<td> A  </td>";
                              
                               
                                echo "</tr>";
                            }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Add this script to the head or before the closing body tag -->


<?php
include('teacher_footer.php');
?>