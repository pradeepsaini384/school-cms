<?php
include('teacher_header.php');
include('../db_connection.php');
$getUsersQuery = "SELECT * FROM event";
$result = $conn->query($getUsersQuery);

?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Event List</h1>
        <a href="event_create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Create Event</a>
    </div>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Users List</h1> -->
    <!-- <p class="mb-4"> <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">All Events</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created_by</th>
                            <th>For</th>
                            <th>DateTime</th>
                            <th>Status</th>
                            <th>View</th>
                            <th>Edit</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Created_by</th>
                            <th>For</th>
                            <th>DateTime</th>
                            <th>Status</th>
                            <th>View</th>
                            <th>Edit</th>


                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        // Loop through each row in the result set and display user data
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["created_by"] . "</td>";
                            echo "<td>" . $row["event_for"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo '<td>
            <ul style="list-style: none; padding: 0; margin: 0;">
            <li>&nbsp;&nbsp;
            <a href="#" onclick="loadEventDetails('.$row["id"].')" data-toggle="modal" data-target="#myModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
            </svg>
        </a>
        
        
        
                
            </li>
        </ul>
        </td>';
                            echo '<td>
            <ul style="list-style: none; padding: 0; margin: 0;">
            <li>&nbsp;
                <a href="class_edit.php?id=' . $row["id"] . '">
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
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div>
                    <label for="eventName ">Event Name:</label>
                    <p id="eventName"></p>
                </div>
                <div>
                    <label for="eventImage">Event Image:</label>
                    <img id="eventImage" src="" alt="Event Image" class="img-fluid">
                </div>
                <div>
                    <label for="eventDescription">Event Description:</label>
                    <p id="eventDescription"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
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
    
    function loadEventDetails(eventId) {
    // Make an AJAX request to your API
    $.ajax({
        url: '../admin/show_event_data.php?eventId=' + eventId,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Log the data received from the API
            console.log('API Response:', data);

            // Update modal body content with the fetched data
            $('#eventImage').attr('src', data.img); // Assuming 'image' is the key for image URL
            $('#eventName').text(data.name); // Assuming 'image' is the key for image URL
            $('#eventDescription').text(data.detail); // Assuming 'description' is the key for event description

            // Trigger the modal
            $('#myModal').modal('show');
        },
        error: function (error) {
            console.error('Error fetching event details:', error);
            // Handle error as needed
        }
    });
}

</script>

          
        

<?php
include('teacher_footer.php');
?>