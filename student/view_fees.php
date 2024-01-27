<?php
include('header.php');
// include('../create_tables.php');
?>
<style>
        .invoice {
            max-width: 100%;
            margin: 0 auto;
        }

        .invoice-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .invoice-body {
            padding: 20px;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }

        .download-btn {
            margin-top: 20px;
        }
    </style>

   <!-- Begin Page Content -->
   <div class="container-fluid">
                    <div class="card invoice">
                        <div class="card-header invoice-header">
                            <h3>School Fee Invoice</h3>
                        </div>
                        <div class="card-body invoice-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Student Name:</strong> John Doe</p>
                                    <p><strong>Class:</strong> 10th Grade</p>
                                    <p><strong>Semester:</strong> Spring 2024</p>
                                    <p><strong>Parent's Name:</strong> Jane Doe</p>
                                    <p><strong>Mentor's Name:</strong> Mr. Smith</p>
                                    <p><strong>School Name:</strong> XYZ School</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p><strong>Invoice Number:</strong> #123456</p>
                                    <p><strong>Issue Date:</strong> January 15, 2024</p>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>School Tuition Fee</td>
                                        <td class="text-right">$500.00</td>
                                    </tr>
                                    <tr>
                                        <td>Books and Supplies</td>
                                        <td class="text-right">$50.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="invoice-total">
                                <p><strong>Total:</strong> $550.00</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Head Office Signature:</strong> ____________________</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-primary download-btn">Download Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php
include('footer.php');
// include('../create_tables.php');
?>
