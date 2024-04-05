<?php
  $eventId = $participant->eventtype_id;
  $sql="SELECT * FROM tbleventtype WHERE ID=:eventId";
  $query = $dbh -> prepare($sql);
  $query->bindParam(':eventId', $eventId, PDO::PARAM_STR);
  $query->execute();
  $eventDetail = $query->fetch(PDO::FETCH_OBJ);

  if($query->rowCount() != 1) {
    echo "<script> alert('Participant Event Details Was Not Found!'); </script>";
    echo "<script>window.location.href = 'manage_event_participant.php?eventid=$eventId'</script>";
  }
?>

<div class="col-sm-12 mb-5">
  <div id="div-id-card" style="">
    <table border="0" style="border:1px solid grey; width:470px;">
      <tr>
        <td style="padding:3px;">
          <div style="height:100px; width:100px; text-align:center; border:1px solid grey; border-radius:3px;">
            <?php
              if(empty($participant->passport_photo))
              { 
                ?>
                <img class="img-avatar" alt="Passport Photograph" src="assets/img/avatars/avatar15.jpg" alt="">
                <?php 
              } else { 
                ?>
                <img class="img-avatar" alt="Passport Photograph" width="100%" src="assets/img/profileimages/<?php  echo $participant->passport_photo;?>" alt=""> 
                <?php 
              } ?>
          </div>
        </td>

        <td style="vertical-align:top; padding-top:5px;">
          <div style="text-align:center; padding-top:1px; vertical-align:top;">
              <b><?php echo strtoupper($eventDetail->EventType) ?></b><br>

              <small>
                <b>Start Date:</b> <?php  echo htmlentities(date('jS M, Y h:m:s a', strtotime($eventDetail->start_date)));?><br>

                <b>End Date:</b> <?php  echo htmlentities(date('jS M, Y h:m:s a', strtotime($eventDetail->end_date)));?>
              </small>
          </div>
        </td>

        <td style="padding:3px;">
          <div style="height:100px; width:100px; float:right; text-align:center; border:1px solid grey; border-radius:3px;">
            <small><i>
              <img src="assets/img/companyimages/fake_barcode.png" style="width:100%">
            </i></small>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="3" style="padding:5px; margin:0px;">
          <table border="0">
            <tr style="width:100%;">
              <td>
                <div>
                  <small>
                    <div style="text-align:center;">
                      <b><u>PARTICIPANT DETAILS</u></b>
                    </div>
                    <table>
                      <tr>
                        <th>FULLNAME:</th>
                        <td>
                          <i>
                            <?php  echo strtoupper(htmlentities($participant->last_name));?>
                            <?php  echo strtoupper(htmlentities($participant->other_names));?>                          
                          </i>
                        </td>
                        
                        <th colspan="2" style="text-align:right;">GENDER:</th>
                        <td colspan="2">
                          <i>
                            <?php  echo htmlentities(!empty($participant->gender) ? $participant->gender : 'N/A'); ?>
                          </i>
                        </td>
                      </tr>

                      
                      <tr>
                        <th>EMAIL:</th>
                        <td>
                          <i>
                            <?php  echo htmlentities(!empty($participant->email) ? $participant->email : 'N/A'); ?>
                          </i>
                        </td>
                        
                        <th colspan="2" style="text-align:right;">PHONE NUMBER:</th>
                        <td colspan="2">
                          <i>
                            <?php  echo htmlentities(!empty($participant->telephone) ? $participant->telephone : 'N/A'); ?>
                          </i>
                        </td>
                      </tr>

                      <tr>
                        <th>DOB:</th>
                        <td>
                          <i>
                            <?php  echo htmlentities(!empty($participant->dob) ? date('jS M, Y', strtotime($participant->dob)) : 'N/A');?>                          
                          </i>
                        </td>
                        
                        <th style="text-align:right;">ADDRESS:</th>
                        <td colspan="3">
                          <i>
                            <?php  echo htmlentities(!empty($participant->address) ? $participant->address : 'N/A'); ?>
                          </i>
                        </td>
                      </tr>
                    </table>
                    
                  </small>
                </div>

              </td>
            </tr>
          </table>
        </td>
      </tr>


      <tr>
        <td colspan="3" style="padding:5px; margin:0px;">
          <table border="0">
            <tr style="width:100%;">
              <td>
                <div>
                  <small>
                    <div style="text-align:center;">
                      <b><u>NEXT OF KIN DETAILS</u></b>
                    </div>
                    <table>
                      <tr>
                        <th>FULLNAME:</th>
                        <td colspan="5">
                          <i>
                            <?php  echo strtoupper(htmlentities($participant->next_of_kin_full_name));?>
                          </i>
                        </td>
                      </tr>
                      
                      <tr>
                        <th>EMAIL:</th>
                        <td>
                          <i>
                            <?php  echo htmlentities(!empty($participant->next_of_kin_email) ? $participant->next_of_kin_email : 'N/A'); ?>
                          </i>
                        </td>
                        
                        <th colspan="2" style="text-align:right;">PHONE NUMBER:</th>
                        <td colspan="2">
                          <i>
                            <?php  echo htmlentities(!empty($participant->next_of_kin_telephone) ? $participant->next_of_kin_telephone : 'N/A'); ?>
                          </i>
                        </td>
                      </tr>

                      <tr>                      
                        <th colspan="1" style="text-align:left;">ADDRESS:</th>
                        <td colspan="5">
                          <i>
                            <?php  echo htmlentities(!empty($participant->address) ? $participant->next_of_kin_address : 'N/A'); ?>
                          </i>
                        </td>
                      </tr>
                    </table>
                    
                  </small>
                </div>

              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  
  <div style="" class="col-sm-4 text-right m-2">
    <button id="btn-print-dentity-div" class="btn btn-sm btn-danger text-right" onclick="printIdentityDiv()">Print Identity Slip</button>
  </div>
</div>


<script type="text/javascript">
  function printIdentityDiv() {
    // action for printing id
    let printContents = $('#div-id-card').html();
    let printWindow = window.open('', '_blank', 'height=500,width=800');

    printWindow.document.write(printContents);
    printWindow.document.close();

    // Print the contents of the new window pop up
    printWindow.focus();
    printWindow.print();
    printWindow.close();
  }
</script>