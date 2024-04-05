<?php
include('includes/checklogin.php');
check_login();
// Code for deleting product from cart
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="DELETE FROM tbeventparticipants WHERE id=:rid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Participant Data Deleted');</script>"; 
  echo "<script>window.location.href = 'manage_event_participant.php?eventid=$eventId'</script>";
}

  // get the event record
$result = [];
if(isset($_GET['eventid'])) 
{
  $sql = "SELECT * FROM tbleventtype WHERE ID=:eventId";
  $query = $dbh->prepare($sql);
  $query->bindParam(':eventId', $_GET['eventid'], PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);
}
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
                  <h5 class="modal-title" style="float: left;">
                    REGISTERED PARTICIPANTS :: <b><u><?php echo strtoupper($result['EventType']) ?></u></b>
                  </h5>    
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addsector" ><i class="fas fa-plus" ></i> Add Participant
                    </button>
                  </div>    
                </div>
                
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Register New Event Participant</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php @include("newevent_participant.php");?>
                      </div>
                    </div>                    
                  </div>                  
                </div>


                <div id="editData" class="modal fade">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Event Participant Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="info_update">
                                <?php @include("update_event_participant.php");?>
                            </div>                            
                        </div>                        
                    </div>                    
                </div>
                
              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>Participant</th>
                      <th>Email/Phone</th>
                      <th>Address</th>
                      <th>Date Registered</th>
                      <th>Next of Kin Details</th>
                      <th>Registration Officer</th>
                      <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    $sql="SELECT * from tbeventparticipants WHERE eventtype_id=:eventId ORDER BY date_registered_for_event ASC";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':eventId', $_GET['eventid'], PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                        {               ?>
                          <tr class="small">
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td class="font-w600">
                              <small>
                                <a href="view_participant_qrcode.php?eventParticipantId=<?php echo ($row->id);?>" target="__blank">
                                  <b><u>
                                    <?php  echo strtoupper(htmlentities($row->last_name));?>
                                    <?php  echo strtoupper(htmlentities($row->other_names));?>
                                  </u></b>
                                </a>
                                <br>

                                <b>-Gender:</b> <i><?php  echo htmlentities(!empty($row->gender) ? $row->gender : 'N/A'); ?></i><br>
                                <b>-Date of Birth:</b> <i><?php  echo htmlentities(!empty($row->dob) ? date('jS M, Y', strtotime($row->dob)) : 'N/A');?></i><br>
                              </small>
                            </td>

                            <td class="d-none d-sm-table-cell">
                              <small>
                                <i><?php  echo htmlentities($row->email); ?></i><br>
                                <i><?php  echo htmlentities($row->telephone); ?></i>
                              </small>
                            </td>

                            <td class="d-none d-sm-table-cell">
                              <small>
                                <i><?php  echo strtoupper(htmlentities(!empty($row->address) ? $row->address : 'N/A')); ?></i>
                              </small>                              
                            </td>

                            <td class="d-none d-sm-table-cell">
                              <small>
                                <?php  echo htmlentities(date('jS M, Y', strtotime($row->date_registered_for_event)));?><br>
                                <?php  echo htmlentities(date('h:m:s a', strtotime($row->date_registered_for_event)));?>
                              </small>
                            </td>

                            <td>
                              <small>
                                <b>
                                  <?php  echo strtoupper(htmlentities($row->next_of_kin_full_name));?>
                                </b><br>

                                <b>*Email:</b> <i><?php  echo htmlentities(!empty($row->next_of_kin_email) ? $row->next_of_kin_email : 'N/A'); ?></i><br>
                                <b>*Telephone:</b> <i><?php  echo htmlentities(!empty($row->next_of_kin_telephone) ? $row->next_of_kin_telephone : 'N/A'); ?></i><br>
                                <b>*Address:</b> <i><?php  echo htmlentities(!empty($row->next_of_kin_address) ? $row->next_of_kin_address : 'N/A'); ?></i><br>
                              </small>
                            </td>
                                  
                            <td>
                              <?php
                                $sql = "SELECT * FROM tbladmin WHERE ID = :regOfficer";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':regOfficer', $row->registration_officer_id, PDO::PARAM_STR);
                                $query->execute();
                                $result = $query->fetch(PDO::FETCH_ASSOC);
                              ?> 
                              
                              <small>
                                <b>
                                  <?php  echo strtoupper(htmlentities(!empty($result['FirstName']) ? $result['FirstName'] : 'N/A'));?>
                                  <?php  echo strtoupper(htmlentities(!empty($result['LastName']) ? $result['LastName'] : 'N/A'));?>
                                </b><br>
                              </small>
                            </td>

                            <td class="text-center">
                              <small>
                                <a href="view_participant_qrcode.php?eventParticipantId=<?php echo ($row->id);?>" class="rounded btn btn-info" target="__blank">
                                  <i class="mdi mdi-key" aria-hidden="true"></i>
                                </a>

                                <a href="#" class=" edit_data btn btn-purple rounded" id="<?php echo ($row->id); ?>" title="click for edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>

                                <a href="manage_event_participant.php?delid=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to Delete ?');" class="rounded btn btn-danger">
                                  <i class="mdi mdi-delete" aria-hidden="true"></i>
                                </a>
                              </small>
                            </td>

                          </tr>
                          <?php 
                          $cnt=$cnt+1;
                        }
                      } ?>
                  </tbody>

                </table>
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
  <script type="text/javascript">
      $(document).ready(function(){
          $(document).on('click','.edit_data',function()
          {
              var edit_id=$(this).attr('id');
              $.ajax(
              {
                  url:"update_event_participant.php",
                  type:"post",
                  data:{edit_id:edit_id},
                  beforeSend: function(){
                      $(".se-pre-con").show();
                  },
                  complete:function(){
                      $(".se-pre-con").hide();
                  },

                  success:function(data)
                  {
                      $("#info_update").html(data);
                      $("#editData").modal('show');
                  }

              });
          });
      });
  </script>
</body>
</html>
