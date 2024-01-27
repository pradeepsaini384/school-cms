<?php
include('adminheader.php');
include('../db_connection.php');
$totalStudentsQuery = "SELECT COUNT(id) AS total_students FROM students";
$resultTotalStudents = $conn->query($totalStudentsQuery);
$rowTotalStudents = $resultTotalStudents->fetch_assoc();
$totalStudents = $rowTotalStudents['total_students'];

// Total number of male students
$totalMaleStudentsQuery = "SELECT COUNT(id) AS total_male_students FROM students WHERE gender = 'Male'";
$resultTotalMaleStudents = $conn->query($totalMaleStudentsQuery);
$rowTotalMaleStudents = $resultTotalMaleStudents->fetch_assoc();
$totalMaleStudents = $rowTotalMaleStudents['total_male_students'];

// Total number of female students
$totalFemaleStudentsQuery = "SELECT COUNT(id) AS total_female_students FROM students WHERE gender = 'Female'";
$resultTotalFemaleStudents = $conn->query($totalFemaleStudentsQuery);
$rowTotalFemaleStudents = $resultTotalFemaleStudents->fetch_assoc();
$totalFemaleStudents = $rowTotalFemaleStudents['total_female_students'];
$totalactiveStudentsQuery = "SELECT COUNT(id) AS total_active_students FROM students WHERE status = 'active'";
$resultactivestudents = $conn->query($totalactiveStudentsQuery);
$rowTotalactiveStudents = $resultactivestudents->fetch_assoc();
$totalactivestudents = $rowTotalactiveStudents['total_active_students'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">


        <!-- Earnings (Monthly) Card Example -->
         <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Student
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalStudents; ?></div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Male Student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalMaleStudents; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Female Student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalFemaleStudents; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Active Student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalactivestudents; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Passout Student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
    </div>

    <?php
    include('adminfooter.php');
    ?>