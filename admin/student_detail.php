<?php
include('adminheader.php');
?>
<?php
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
                            <th>Edit</th>

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
                            <th>Edit</th>
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
                              
                                echo '<td>
            <ul style="list-style: none; padding: 0; margin: 0;">
            <li>&nbsp;
                <a href="student_Admission.php?id='.$row["id"].'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </a>
            </li>
        </ul>
        </td>';

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
<script>
    function editUser(email) {
        // Make an AJAX request to fetch user data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response
                var userData = JSON.parse(xhr.responseText);

                // Redirect to the edit user page with user data
                window.location.href = 'user_edit.php?email=' + email;
            }
        };

        // Replace 'get_user_data.php' with the actual backend script to fetch user data
        xhr.open('GET', 'user_edit.php?email=' + email, true);
        xhr.send();
    }
</script>

<?php
include('adminfooter.php');
?>