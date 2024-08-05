<?php
include "../connection/config.php";

$district = $_GET['district'];
$sql = "SELECT project_code, sector FROM sector_district WHERE district = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $district);
$stmt->execute();
$result = $stmt->get_result();

$projects_and_sectors = array();
while ($row = $result->fetch_assoc()) {
    $projects_and_sectors[] = $row;
}

echo json_encode($projects_and_sectors);

$stmt->close();
mysqli_close($con);
?>
