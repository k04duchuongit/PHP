<?php
require 'connect.php';
$flights = $conn->query("SELECT * FROM flights")->fetchAll();

print_r($flights);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    img {
        width: 160px;
        height: 200px;
    }
</style>

<body>
    <h1>DANH SÁCH CHUYẾN BAY</h1>
    <button><a href="create.php">Create</a></button>
    <table border="1">
        <tr>
            <th>Flight_ID</th>
            <th>Flight_Number</th>
            <th>Image</th>
            <th>Total_Passengers</th>
            <th>Description</th>
            <th>Airline_id</th>
        </tr>
        <?php
        foreach ($flights as $flight) {
        ?>
            <tr>
                <td><?= $flight['flight_id'] ?></td>
                <td><?= $flight['flight_number'] ?></td>
                <td><img src="<?= $flight['image'] ?>" alt=""></td>
                <td><?= $flight['total_passengers'] ?></td>
                <td><?= $flight['description'] ?></td>
                <td><?= $flight['airline_id'] ?></td>
                <td>
                    <a href="./edit.php?flight_id=<?php echo $flight['flight_id']?>">SỬA</a>
                    <a href="./delete.php?flight_id=<?php echo $flight['flight_id']?>">XÓA</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>