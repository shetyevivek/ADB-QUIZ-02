<!DOCTYPE html>
<html>
<head>
  <title>Answer 10</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

// Input data
$year = $_POST['year'];
$stateco = $_POST['stateco'];

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

mysqli_close($con);

?>