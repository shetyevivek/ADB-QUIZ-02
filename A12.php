<!DOCTYPE html>
<html>
<head>
  <title>Answer 12</title>
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
$name = $_POST['name'];

$sql = "SELECT * FROM ptelect WHERE candidate LIKE '$name%' OR candidate LIKE '%$name' OR candidate LIKE '%$name%'";
$result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

echo "<table border='1'>
<tr>
<th style='padding:15px;'>Year</th>
<th style='padding:15px;'>Candidate Name</th>
<th style='padding:15px;'>No. of Votes</th>
</tr>";

while ($row = mysqli_fetch_array($result))
{
  echo "<tr>";
  echo "<td style='padding:15px;'>" . $row['year'] . "</td>";
  echo "<td style='padding:15px;'>" . $row['candidate'] . "</td>";
  echo "<td style='padding:15px;'>" . $row['candidatevotes'] . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br><br>";

mysqli_close($con);

//End time
$end = microtime(true);
echo "Query time = " .round($end - $start, 4);
?>