<?php
include('../configs/database.php');

if (isset($_GET['country_id'])) {
    $countryId = $_GET['country_id'];
    $query = "SELECT * FROM cities WHERE country_id = $countryId";
    $result = $connection->query($query);

    $cities = array();
    while ($city = mysqli_fetch_assoc($result)) {
        $cities[] = $city;
    }

    echo json_encode($cities);
} else {
    echo json_encode(array());
}
?>
