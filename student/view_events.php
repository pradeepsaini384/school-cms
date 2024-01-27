<?php
include('header.php');
include('../db_connection.php');
$getUsersQuery = "SELECT * FROM event";
$result = $conn->query($getUsersQuery);

// include('../create_tables.php');
?>

<div class="container-fluid">
<ul class="list-group">
<?php
        // Check if there are events in the result
        if ($result->num_rows > 0) {
            // Loop through each event and create a card
            while ($event = $result->fetch_assoc()) {
        ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">

          <span class="badge badge-primary badge-pill">Important
            </span><?= $event['name'] ?>
            
            <span class="badge badge-primary badge-pill">
    <button class="btn btn-primary" onclick="loadEvent(<?= $event['id'] ?>)" data-toggle="modal" data-target="#myModal">View</button>
</span>
        <?php
            }
        } else {
            echo '<p>No events available.</p>';
        }
        ?>
  <!-- <li class="list-group-item"><?= $event['name'] ?></li> -->

</ul>
    <div class="row">
    
        <?php
        // Check if there are events in the result
        if ($result->num_rows > 0) {
            // Loop through each event and create a card
            while ($event = $result->fetch_assoc()) {
        ?>
                <div class="col-md-4">
                    <div class="card event-card">
                        <img src="<?= $event['img'] ?>" class="card-img-top" alt="<?= $event['name'] ?> Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $event['name'] ?></h5>
                            <p class="card-text"><?= $event['detail'] ?></p>
                            <p class="card-text"><strong>Date:</strong> <?= $event['date'] ?></p>
                            <p class="card-text"><strong>Time:</strong> <?= $event['date'] ?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p>No events available.</p>';
        }
        ?>
    </div>
</div>
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
<script>
    function loadEvent(eventId) {
    // Make an AJAX request to your API
    $.ajax({
        url: 'show_event_data.php?eventId=' + eventId,
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
                <!-- /.container-fluid -->
<?php
include('footer.php');
// include('../create_tables.php');
?>
