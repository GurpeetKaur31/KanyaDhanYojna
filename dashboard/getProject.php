<?php
include "../connection/config.php";

$sql = "SELECT district, project_name FROM sector_district";
$result = mysqli_query($con, $sql);

$projects = array();
while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = $row;
}

echo json_encode($projects);

mysqli_close($con);
?>
