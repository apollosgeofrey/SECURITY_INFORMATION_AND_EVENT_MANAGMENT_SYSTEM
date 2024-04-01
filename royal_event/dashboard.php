<?php 
include('includes/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    
    <?php @include("includes/header.php");?>
    
    <div class="container-fluid page-body-wrapper">
      
      
      <div class="main-panel"><br>
        <div class="content-wrapper">

          <div class="row" >
            <div class="col-sm-12 col-md-6">
              <div class="row">
                <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-primary card-img-holder text-white"style="height: 130px;">
                <div class="card-body" >
                  <h4 class="font-weight-normal mb-3">Total Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID FROM tbleventtype";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $totalevents=$query->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($totalevents);?></h2>
                </div>
              </div>
            </div>

            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Upcoming Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID FROM tbleventtype WHERE NOW() < start_date";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $upcomingevents=$query->rowCount();
                  $upcomingeventspct=(100 * $upcomingevents)/$totalevents;

                  ?> 
                  <h2 class="mb-5"><?php echo htmlentities($upcomingevents);?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-warning  card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Completed Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID FROM tbleventtype WHERE end_date <= NOW()";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $completedevents=$query->rowCount();
                  $completedeventspct=(100 * $completedevents)/$totalevents;
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($completedevents);?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Ongoing Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID FROM tbleventtype WHERE NOW() >= start_date  AND end_date > NOW()";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $ongoingevents=$query->rowCount();
                  $ongoingeventspct=(100 * $ongoingevents)/$totalevents;
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($ongoingevents);?></h2>
                </div>
              </div>
            </div>
            </div>
            </div>
            <div class="col-sm-12 col-md-6">
               <div id="piechart" style="width:100%; height: 300;"></div>
            </div>        
        
        <?php @include("includes/footer.php");?>
        
      </div>
      
    </div>

  </div>

  <?php @include("includes/foot.php");?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Chart Heading', 'Application Events Percentages'],
          ['Upcoming Events', <?php echo $upcomingeventspct; ?>],
          ['Completed Events', <?php echo $completedeventspct; ?>],
          ['', 0],
          ['Ongoing Events', <?php echo $ongoingeventspct; ?>],
        ]);

        var options = {
          title: 'Events Chart Analysis'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</body>
</html>


