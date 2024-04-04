
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['saveupdates']))
{

  $eventParticipantId = $_SESSION['editid2'];
  $last_name = $_POST['last_name'];
  $other_names = $_POST['other_names'];
  $email = !empty($_POST['email']) ? $_POST['email'] : null;
  $telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : null;
  $gender = $_POST['gender'];
  $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
  $address = !empty($_POST['address']) ? $_POST['address'] : null;
  $next_of_kin_full_name = $_POST['next_of_kin_full_name'];
  $next_of_kin_email = !empty($_POST['next_of_kin_email']) ? $_POST['next_of_kin_email'] : null;
  $next_of_kin_telephone = !empty($_POST['next_of_kin_telephone']) ? $_POST['next_of_kin_telephone'] : null;
  $next_of_kin_address = !empty($_POST['next_of_kin_address']) ? $_POST['next_of_kin_address'] : null;
  $registration_officer_id = $_SESSION['odmsaid'];

  // image upload
  $passport_photo = !empty($_FILES["passport_photo"]["name"]) ? $_FILES["passport_photo"]["name"] : null;
  move_uploaded_file($_FILES["passport_photo"]["tmp_name"], "assets/img/profileimages/".$_FILES["passport_photo"]["name"]);

  $sql4 = "UPDATE tbeventparticipants SET last_name=:last_name, other_names=:other_names, email=:email, telephone=:telephone, gender=:gender, dob=:dob, address=:address, next_of_kin_full_name=:next_of_kin_full_name, next_of_kin_email=:next_of_kin_email, next_of_kin_telephone=:next_of_kin_telephone, next_of_kin_address=:next_of_kin_address, registration_officer_id=:registration_officer_id, passport_photo=:passport_photo WHERE id=:eventParticipantId";

  $query4 = $dbh->prepare($sql4);
  $query4->bindParam(':last_name', $last_name, PDO::PARAM_STR);
  $query4->bindParam(':other_names', $other_names, PDO::PARAM_STR);
  $query4->bindParam(':email', $email, PDO::PARAM_STR);
  $query4->bindParam(':telephone', $telephone, PDO::PARAM_STR);
  $query4->bindParam(':gender', $gender, PDO::PARAM_STR);
  $query4->bindParam(':dob', $dob, PDO::PARAM_STR);
  $query4->bindParam(':address', $address, PDO::PARAM_STR);
  $query4->bindParam(':next_of_kin_full_name', $next_of_kin_full_name, PDO::PARAM_STR);
  $query4->bindParam(':next_of_kin_email', $next_of_kin_email, PDO::PARAM_STR);
  $query4->bindParam(':next_of_kin_telephone', $next_of_kin_telephone, PDO::PARAM_STR);
  $query4->bindParam(':next_of_kin_address', $next_of_kin_address, PDO::PARAM_STR);
  $query4->bindParam(':registration_officer_id', $registration_officer_id, PDO::PARAM_STR);
  $query4->bindParam(':passport_photo', $passport_photo, PDO::PARAM_STR);
  $query4->bindParam(':eventParticipantId', $eventParticipantId, PDO::PARAM_STR);

  $query4->execute();

  if ($query4->execute()) {
    echo '<script>alert("Event Participant has been updated.")</script>';
    $eventId = intval($_GET['eventid']);
    echo "<script>window.location.href = 'manage_event_participant.php?eventid=$eventId'></script>";
  }else{
    echo '<script>alert("Update failed! try again later")</script>';
  }
}
?>
<div class="card-body">
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
      
      <?php
      $eid=$_POST['edit_id'];
      $sql="SELECT * from  tbeventparticipants where tbeventparticipants.id=:eid";
      $query = $dbh -> prepare($sql);
      $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
      $query->execute();
      $result=$query->fetch(PDO::FETCH_OBJ);

      if($query->rowCount() > 0)
      {
          $_SESSION['editid2']=$result->id;
      ?> 

        <div class="row">
          <hr>
          <div class="row col-sm-12 text-danger">
            PARTICIPANT DETAILS
          </div>
          <hr>
          <div class="form-group col-sm-4">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required='required' value="<?php echo $result->last_name ?>">
          </div>

          <div class="form-group col-sm-4">
            <label for="other_names">Other Names:</label>
            <input type="text" name="other_names" class="form-control" id="other_names" placeholder="Other Names" value="<?php echo $result->other_names ?>" required>
          </div>

          <div class="form-group col-sm-4">
            <label for="email">Email Address: (Optional)</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="<?php echo $result->email ?>">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-4">
            <label for="telephone">Telephone: (Optional)</label>
            <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo $result->telephone ?>">
          </div>

          <div class="form-group col-sm-4">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control" required>
              <option value="" <?php echo $result->gender==null ? 'selected' : '' ?>>-- None Selected --</option>
              <option value="male" <?php echo $result->gender=='male' ? 'selected' : '' ?>>Male</option>
              <option value="female" <?php echo $result->gender=='female' ? 'selected' : '' ?>>Female</option>
            </select>
          </div>

          <div class="form-group col-sm-4">
            <label for="dob">Date of Birth: (Optional)</label>
            <input type="date" name="dob" class="form-control" id="dob" value="<?php echo $result->dob ?>">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6">
            <label for="passport_photo">Passport Photo: (Optional: Old file will be replaced if another is selected) </label>
            <input type="file" name="passport_photo" class="form-control" id="passport_photo">
          </div>

          <div class="form-group col-sm-6">
            <label for="address">Address: (Optional)</label>
            <textarea name="address" class="form-control" id="address" placeholder="Participant Address" rows="1"><?php echo $result->address ?></textarea>
          </div>
        </div>

        <hr>
        <div class="row col-sm-12 text-danger">
          NEXT OF KIN DETAILS
        </div>
        <hr>
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="next_of_kin_full_name">Full Name:</label>
            <input type="text" name="next_of_kin_full_name" class="form-control" id="next_of_kin_full_name" placeholder="Next of Kin Full Name" value="<?php echo $result->next_of_kin_full_name ?>" required>
          </div>

          <div class="form-group col-sm-6">
            <label for="next_of_kin_address">Next of Kin address: (Optional)</label>
            <textarea name="next_of_kin_address" class="form-control" id="next_of_kin_address" placeholder="Next of Kin address" rows="1"><?php echo $result->next_of_kin_address ?></textarea>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6">
            <label for="next_of_kin_email">Next of Kin Email: (Optional)</label>
            <input type="text" name="next_of_kin_email" class="form-control" id="next_of_kin_email" placeholder="Next of Kin Email" value="<?php echo $result->next_of_kin_email ?>">
          </div>

          <div class="form-group col-sm-6">
            <label for="next_of_kin_telephone">Next of Kin Telephone: (Optional)</label>
            <input type="text" name="next_of_kin_telephone" class="form-control" id="next_of_kin_telephone" placeholder="Next of Kin Telephone" value="<?php echo $result->next_of_kin_telephone ?>">
          </div>
        </div>
        
    <?php } ?>

        <div class="form-group mt-5 text-right">
            <button type="submit" name="saveupdates" class="btn btn-primary btn-fw mr-2">Update Participant</button>
        </div>
  </form>
</div>