<?php
include('includes/checklogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>

  <div class="container-scroller">
    
    <?php @include("includes/header.php");?>
    
    <div class="container-fluid page-body-wrapper">    
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">VERIFIED EVENT PARTICIPANT IDENTITY</h5>
                </div>

              <div class="card-body table-responsive p-3">
                <?php
                    $eventParticipantId = $_GET['eventParticipantId'];
                    $sql="SELECT * from tbeventparticipants WHERE id=:eventParticipantId";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':eventParticipantId', $eventParticipantId, PDO::PARAM_STR);
                    $query->execute();
                    $participant = $query->fetch(PDO::FETCH_OBJ);

                    if($query->rowCount() > 0) {
                  
                      @include("includes/participant_id_card_template.php");

                    } else {
                      echo "<div class='text-danger text-center'><i>No Verification Identity Details Found!</i></div>";
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <?php @include("includes/footer.php");?>
        
      </div>
      
    </div>
    
  </div>
  
  <?php @include("includes/foot.php");?>
</body>
</html>
