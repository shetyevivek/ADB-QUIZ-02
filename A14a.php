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

// Input data
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

    $file_handle = fopen($Memcache_file, 'w');
    fclose($file_handle);

    for ($i = 0; $i < $ntimes; $i++)
    {
        $sql = "SELECT * FROM ptelect WHERE year=$year AND state_po='$stateco'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $str = "<table border='1'>";
        $str .= "<tr><th style='padding:15px;'>Candidate Name</th><th style='padding:15px;'>Party</th><th style='padding:15px;'>No. of Votes</th><th>State</th></tr>";
        foreach ($arr as $list)
        {
            $str .= "<tr><td style='padding:15px;'>" . $list['candidate'] . "</td><td style='padding:15px;'>" . $list['party_detailed'] . "</td><td style='padding:15px;'>" . $list['candidatevotes'] . "</td><td style='padding:15px;'>" . $list['state'] . "</td></tr>";
        }
        $str .= "</table><br><br><br>";

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