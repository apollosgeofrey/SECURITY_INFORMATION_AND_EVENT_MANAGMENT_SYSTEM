<?php
include('includes/checklogin.php');
check_login();
// Code for deleting product from cart
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="delete from tbleventtype where ID=:rid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage_event.php'</script>";
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
                  <h5 class="modal-title" style="float: left;">List Registered Events</h5>    
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addsector" ><i class="fas fa-plus" ></i> Add New Event
                    </button>
                  </div>    
                </div>
                
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Register New Event</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php @include("newevent.php");?>
                      </div>
                    </div>                    
                  </div>                  
                </div>
                
                <div id="editData" class="modal fade">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Event Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="info_update">
                                <?php @include("update_event.php");?>
                            </div>                            
                        </div>                        
                    </div>                    
                </div>

              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>Event Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Creation Date</th>
                      <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    $sql="SELECT * from tbleventtype ORDER BY CreationDate ASC";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                        {               ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td class="font-w600">
                              <a href="manage_event_participant.php?eventid=<?php echo ($row->ID);?>">
                                <b><u>
                                  <?php  echo strtoupper(htmlentities($row->EventType));?>
                                  
                                  <?php
                                    $sql = "SELECT COUNT(*) AS row_count FROM tbeventparticipants WHERE eventtype_id = :eventId";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eventId', $row->ID, PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetch(PDO::FETCH_ASSOC);
                                  ?>  

                                  <small class="text-danger">-- <?php echo $result['row_count'] ?> PARTICIPANTS</small>  
                                </u></b>
                              </a>
                              <div class="">
                                <small>
                                  <b class="fw-bold">Description:</b>
                                  <i><?php  echo htmlentities($row->eventDescription ?? ' N/A');?></i>
                                </small>                                
                              </div>
                            </td>
                            <td class="d-none d-sm-table-cell">
                              <?php  echo htmlentities(date('jS M, Y', strtotime($row->start_date)));?><br>
                              <?php  echo htmlentities(date('h:m:s a', strtotime($row->start_date)));?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                              <?php  echo htmlentities(date('jS M, Y', strtotime($row->end_date)));?><br>
                              <?php  echo htmlentities(date('h:m:s a', strtotime($row->end_date)));?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                              <?php  echo htmlentities(date('jS M, Y', strtotime($row->CreationDate)));?><br>
                              <?php  echo htmlentities(date('h:m:s a', strtotime($row->CreationDate)));?>
                            </td>
                            <td class="text-center">
                              <a href="manage_event_participant.php?eventid=<?php echo ($row->ID);?>" class="rounded btn btn-info">
                                <i class="mdi mdi-eye" aria-hidden="true"></i>
                              </a>

                              <a href="#"  class=" edit_data btn btn-purple rounded" id="<?php echo ($row->ID); ?>" title="click for edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>

                              <a href="manage_event.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');" class="rounded btn btn-danger">
                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                              </a>
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
                  url:"update_event.php",
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
