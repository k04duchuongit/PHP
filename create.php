<?php
require 'connect.php';
$airlines = $conn->query("SELECT * FROM airlines")->fetchAll();

$dest = 'image/' . basename($_FILES['image']['name']);
$temp = $_FILES['image']['tmp_name'];
move_uploaded_file($temp, $dest);

if(isset($_REQUEST['submit'])){
    $flynumber = $_REQUEST['flight_number'];
    $img = $dest;
    $total= $_REQUEST['total_passengers'];
    $dep = $_REQUEST['description'];
    $air = $_REQUEST['airline_id'];

    $sql = "INSERT INTO flights (flight_number,image,total_passengers,description,airline_id) VALUES ('$flynumber','$img','$total','$dep','$air')";
    $conn->exec($sql); 
    header('Location: ./index.php');   
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./create.php" method="POST" enctype="multipart/form-data">
        <label for="flight_number">Fly_Number</label>
        <input type="text" name="flight_number">
        <br>

        <label for="image">Image</label>
        <input type="file" name="image">
        <br>

        <label for="total_passengers">Passengers</label>
        <input type="number" name="total_passengers">
        <br>

        <label for="description">Description</label>
        <input type="text" name="description">
        <br>

        <label for="airline_id">Airline</label>
        <select name="airline_id">
            <?php
            foreach ($airlines as $airline) { ?>
                <option value="<?= $airline['airline_id'] ?>">
                    <?= $airline['airline_name'] ?>
                </option>
            <?php  }
            ?>
        </select>
       <button type="submit" name="submit">submit</button>
    </form>
</body>

</html>