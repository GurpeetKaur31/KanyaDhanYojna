<?php
include "../connection/config.php";

$sql = "SELECT DISTINCT district FROM sector_district";
$result = mysqli_query($con, $sql);

$districts = array();
while ($row = mysqli_fetch_assoc($result)) {
    $districts[] = $row['district'];
}

echo json_encode($districts);

mysqli_close($con);
?>
