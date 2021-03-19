<!DOCTYPE html>
<html>
<head>
  <title>Answer 13a</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
  </div>
</body>
</html>

<?php
//Start time
$start = microtime(true);

include_once 'connection.php';

// Input data
$year = $_POST['year'];
$stateco = $_POST['stateco'];
$ntimes = $_POST['ntimes'];

for($i=0; $i < $ntimes; $i++)
{
  $sql = "SELECT * FROM ptelect WHERE year=$year AND state_po='$stateco'";
  $result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

  echo "<table border='1'>
  <tr>
  <th style='padding:15px;'>Candidate Name</th>
  <th style='padding:15px;'>Party</th>
  <th style='padding:15px;'>No. of Votes</th>
  <th style='padding:15px;'>State</th>
  </tr>";

  while ($row = mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td style='padding:15px;'>" . $row['candidate'] . "</td>";
    echo "<td style='padding:15px;'>" . $row['party_detailed'] . "</td>";
    echo "<td style='padding:15px;'>" . $row['candidatevotes'] . "</td>";
    echo "<td style='padding:15px;'>" . $row['state'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "<br><br>";
}

mysqli_close($con);

//End time
$end = microtime(true);
echo "Query time = " .round($end - $start, 4);
?>