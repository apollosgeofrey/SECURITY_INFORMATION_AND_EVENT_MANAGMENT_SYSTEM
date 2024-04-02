<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $event=$_POST['event'];
  $eventDescription=!empty($_POST['eventDescription']) ? $_POST['eventDescription'] : null;
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];

  $sql = "INSERT INTO tbleventtype(EventType, eventDescription, start_date, end_date) VALUES (:event, :eventDescription, :start_date, :end_date)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':event', $event, PDO::PARAM_STR);
  $query->bindParam(':eventDescription', $eventDescription, PDO::PARAM_STR);
  $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);


  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Event has been added.")</script>';
    echo "<script>window.location.href = 'manage_event.php'</script>";
  } else {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}
?>
<div class="card-body">
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="exampleInputName1">Event Name:</label>
      <input type="text" name="event" class="form-control" id="event" placeholder="Event Name" required>
    </div>

    <div class="form-group">
      <label for="eventDescription">Event Description: (Optional)</label>
      <textarea name="eventDescription" class="form-control" id="eventDescription" placeholder="Event Description"></textarea>
    </div>

    <?php
      $todayDate = date('Y-m-d');
    ?>

    <div class="row">
      <div class="col-sm-6">
        <label for="start_date">Start Date:</label>
        <input type="datetime-local" name="start_date" class="form-control" id="start_date" required='required' min="<?php echo $todayDate; ?>" >
      </div>

      <div class="col-sm-6">
        <label for="end_date">End Date:</label>
        <input type="datetime-local" name="end_date" class="form-control" id="end_date" required="required" min="<?php echo $todayDate; ?>" >
      </div>
    </div>

    <div class="form-group mt-5 text-right">
      <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Save Event</button>
    </div>
  </form>
</div>