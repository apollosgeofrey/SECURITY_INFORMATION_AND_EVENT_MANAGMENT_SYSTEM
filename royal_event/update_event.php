
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['saveupdates']))
{
  $eventId=$_SESSION['editid2'];
  $EventType=$_POST['event'];
  $eventDescription=!empty($_POST['eventDescription']) ? $_POST['eventDescription'] : null;
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];

  $sql4="UPDATE tbleventtype SET EventType=:EventType, eventDescription=:eventDescription, start_date=:start_date, end_date=:end_date WHERE ID=:eventId";
  $query4 = $dbh->prepare($sql4);
  $query4->bindParam(':EventType', $EventType, PDO::PARAM_STR);
  $query4->bindParam(':eventDescription', $eventDescription, PDO::PARAM_STR);
  $query4->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $query4->bindParam(':end_date', $end_date, PDO::PARAM_STR);
  $query4->bindParam(':eventId', $eventId, PDO::PARAM_STR);
  $query4->execute();
  if ($query4->execute()) {
    echo '<script>alert("Event has been updated")</script>';
    echo "<script>window.location.href = 'manage_event.php'</script>";
  }else{
    echo '<script>alert("Update failed! try again later")</script>';
  }
}
?>


<div class="card-body">
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">

   <?php
      $eid=$_POST['edit_id'];
      $sql="SELECT * from  tbleventtype where tbleventtype.ID=:eid";
      $query = $dbh -> prepare($sql);
      $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $row)
        { 
          $_SESSION['editid2']=$row->ID;
        // var_dump($row->EventType);
          ?>      

          <div class="form-group">
            <label for="exampleInputName1">Event Name:</label>
            <input type="text" name="event" class="form-control" id="event" placeholder="Event Name" value="<?php  echo $row->EventType;?>"  required>
          </div>

          <div class="form-group">
            <label for="eventDescription">Event Description: (Optional)</label>
            <textarea name="eventDescription" class="form-control" id="eventDescription" placeholder="Event Description"><?php  echo $row->eventDescription;?></textarea>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <label for="start_date">Start Date:</label>
              <input type="datetime-local" name="start_date" class="form-control" id="start_date" value="<?php  echo $row->start_date;?>"  required='required'>
            </div>

            <div class="col-sm-6">
              <label for="end_date">End Date:</label>
              <input type="datetime-local" name="end_date" class="form-control" id="end_date" value="<?php  echo $row->end_date;?>"  required="required">
            </div>
          </div>

        <?php $cnt=$cnt+1;
      }
    } ?>

      <div class="form-group mt-5 text-right">
        <button type="submit" name="saveupdates" class="btn btn-primary btn-fw mr-2">Update Event</button>
      </div>
  </form>
</div>