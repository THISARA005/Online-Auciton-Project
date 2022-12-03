<?php

include './db/config.php';
$countq = "SELECT COUNT(`ve_id`) as `tauc`, `ve_date` FROM `vehicles`";
$where = ' WHERE';
$group = ' GROUP BY `ve_date`';
$and = ' 1';
if (isset($_GET['date'])) {
  if ($_GET['starting_date']) {
    $strtdate = $_GET['starting_date'];
    $and .= " AND `ve_date` >= '$strtdate'";
  }
  if (isset($_GET['ending_date'])) {
    $enddate = $_GET['ending_date'];
    $and .= " AND `ve_date` <= '$enddate'";
  }
}
$countQ = $countq .''. $where .'' . $and. '' . $group;

$countQ = mysqli_query($conn, $countQ);
?>
<div class="chrt">
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
    <div>
      <label>Starting Date</label>
      <input type="date" name='starting_date' required>
    </div>
    <div>
      <label>Ending Date</label>
      <input type="date" name='ending_date' required>
    </div>
    <input type="submit" name='date' value ='Search'>
  </form>
</div>
<?php if (mysqli_num_rows($countQ) > 0) { ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Date', 'Auction'],
        <?php while ($row = mysqli_fetch_assoc($countQ)) { ?>['<?php echo $row['ve_date'] ?>', <?php echo $row['tauc'] ?>],

        <?php } ?>
      ]);

      var options = {
        chart: {
          title: 'Eauction System',
          subtitle: '<?php if(isset($_GET['date'])){echo "Auction added from:- ".$_GET['starting_date']. " - " .$_GET['ending_date'];}else{echo 'Auction added till today: - '.date('Y-M-d');} ?>',
        },
        bars: 'vertical' // Required for Material Bar Charts.
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

  <div id="barchart_material" style="width: 100%; height: 500px;"></div>
<?php } else {
  echo "<h2 style='color: red;'>No Record Found !</h2>";
} ?>