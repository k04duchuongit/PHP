<?php
require 'connect.php';
$id = $_GET['flight_id'];

$flight = $conn->query("SELECT * FROM flights WHERE flight_id ='$id'")->fetch();

$airlines = $conn->query("SELECT * FROM airlines")->fetchAll();
$errFlyNumber = $errPassengers = $errDescription = '';

if (isset($_POST['submit'])) {
    $counterr = 0;
    if (empty($_POST['flight_number']) === 0) {
        $errFlyNumber = 'không được để trống';
        $counterr += 1;
    }
    if (empty($_POST['total_passengers']) > 0) {
        $errPassengers = 'phai lon hon khong';
        $counterr += 1;
    }
    if (empty($_POST['description']) === 0) {
        $errDescription = 'không được để trống';
        $counterr += 1;
    }
    if ($counterr === 0) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $dest = 'image/' . basename($_FILES['image']['name']);
            $temp = $_FILES['image']['tmp_name'];
            move_uploaded_file($temp, $dest); //chuyen file tu bo nho tam sang thu muc muon luu tru
            $image = $dest; //lưu đường dẫn lưu ảnh vào trường image
        } else {
            $image = $flight['image'];
        }
        $flynumber = $_POST['flight_number'];
        $total = $_POST['total_passengers'];
        $dep = $_POST['description'];
        $air = $_POST['airline_id'];

        $sql = "UPDATE flights SET flight_number = '$flynumber' ,image = '$image', total_passengers= '$total',description = '$dep' ,airline_id = '$air'
        WHERE flight_id = $id";
        $conn->exec($sql);
        header('Location: ./index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./edit.php" method="POST" enctype="multipart/form-data">
        <label for="flight_number">Fly_Number</label>
        <input type="text" name="flight_number" value="<?= $flight['flight_number'] ?>">
        <p>
            <?= $errFlyNumber ?>
        </p>
        <br>

        <label for="image">Image</label>
        <input type="file" name="image" value="value=<?= $flight['image'] ?>">
        <br>

        <label for="total_passengers">Passengers</label>
        <input type="number" name="total_passengers" value="<?= $flight['total_passengers'] ?>">
        <p>
            <?= $errPassengers ?>
        </p>
        <br>

        <label for="description">Description</label>
        <input type="text" name="description" value="<?= $flight['description'] ?>">
        <p>
            <?= $errDescription ?>
        </p>
        <br>

        <label for="airline_id">Airline</label>
        <select name="airline_id">
            <?php
            foreach ($airlines as $airline) {
            ?>
                <?php if ($flight['airline_id'] == $airline['airline_id']) { ?>
                    <option selected value="$airline['airline_id']"> <?= $airline['airline_name'] ?></option>
                <?php } else { ?>
                    <option value="$airline['airline_id']"> <?= $airline['airline_name'] ?></option>
                <?php }
                ?>
            <?php }
            ?>
        </select>
        <button type="submit" name="submit">submit</button>
    </form>
</body>

</html>