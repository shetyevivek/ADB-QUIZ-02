<!DOCTYPE html>
<html>
<head>
    <title>Answer 14a</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2>
  </div>
  </div>
</body>
</html>

<?php
//Start time
$start = microtime(true);

$con = new PDO("mysql:host=uta.cloud; dbname=vvs1620_database", "vvs1620_vivekshetye", "Shaleshwar12@");

$year = $_POST['year'];
$stateco = $_POST['stateco'];
$ntimes = $_POST['ntimes'];

$Memcache_file = "Memcache/index.cache.php";

if (file_exists($Memcache_file) && filemtime($Memcache_file) > time() - 30)
{
    echo "<b>From Cache:</b><br><br>";
    include ($Memcache_file);
}
else
{
    echo "<b>Cache Created:</b><br><br/>";

    for ($i = 0; $i < $ntimes; $i++)
    {
        $sql = "SELECT * FROM ptelect WHERE year=$year AND state_po='$stateco'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $str = "<table border='1'>";
        $str .= "<tr><th>Candidate Name</th><th>Party Name</th><th>No. of Votes</th><th>State</th></tr>";
        foreach ($arr as $list)
        {
            $str .= "<tr><td>" . $list['candidate'] . "</td><td>" . $list['party_detailed'] . "</td><td>" . $list['candidatevotes'] . "</td><td>" . $list['state'] . "</td></tr>";
        }
        $str .= "</table><br><br>";

        $handle = fopen($Memcache_file, 'a');
        fwrite($handle, $str);
        fclose($handle);
        echo $str;
    }
}

//End time
$end = microtime(true);
echo "Query Time = " .round($end - $start, 4);
?>