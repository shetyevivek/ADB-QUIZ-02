<!DOCTYPE html>
<html>
<head>
    <title>Answer 14b</title>
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
$v1 = $_POST['v1'];
$v2 = $_POST['v2'];
$y1 = $_POST['y1'];
$y2 = $_POST['y2'];
$ntimes = $_POST['ntimes'];

$Memcache_file = "Memcache/index2.cache.php";

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
        $sql = "SELECT * FROM ptelect WHERE candidatevotes BETWEEN $v1 AND $v2 AND year BETWEEN $y1 AND $y2";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $str = "<table border='1'>";
        $str .= "<tr><th style='padding:15px;'>State</th><th style='padding:15px;'>Candidate Name</th><th style='padding:15px;'>Party</th><th>No. of Votes</th><th style='padding:15px;'>State</th></tr>";
        foreach ($arr as $list)
        {
            $str .= "<tr><td style='padding:15px;'>" . $list['state'] . "</td><td style='padding:15px;'>" . $list['candidate'] . "</td><td style='padding:15px;'>" . $list['party_detailed'] . "</td><td style='padding:15px;'>" . $list['candidatevotes'] . "</td><td style='padding:15px;'>" . $list['state'] . "</td></tr>";
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