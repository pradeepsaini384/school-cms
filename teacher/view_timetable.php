<?php
include('teacher_header.php');

include('../db_connection.php');

?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Teacher Timetable</h1>
        <!-- <a href="class_create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-user fa-sm text-white-50"></i> Create Class</a> -->
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
            <th scope="col">Time</th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
        </tr>
    </thead>
    <tbody>
        <!-- Row for 8.00am-9.00am -->
        <tr>
            <th scope="row">8.00am - 9.00am</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
      
        <tr>
            <th scope="row">9.00am - 10.00am</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
        
        <tr>
            <th scope="row">10.00am - 11.00am</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
        
        <tr>
            <th scope="row">11.00am - 12.00pm</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
        
        <tr>
            <th scope="row">12.00pm  - 1.00pm</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
        
        <tr>
            <th scope="row">1.00pm - 2.00pm</th>
            <!-- Add your cells for each day -->
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
            <td>Class info</td>
        </tr>
        
        <!-- Repeat for other time slots and days -->
    </tbody>
                 
                </table>
            </div>
        </div>
    </div>

</div>


<?php
include('teacher_footer.php');
?>