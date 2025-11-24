<?php 
    include "reusable/connect.php";
    $id = "";
    $amenities = "";
    $url = "";
    $address = "";
    if(isset($_GET['id'])) {
        $query = 'SELECT `_id`, `ASSET_NAME`, `AMENITIES`, `ADDRESS`, `URL` FROM parks_and_recreation_facilities___4326 WHERE _id=' . $_GET['id'];
        $result = mysqli_query($connect, $query);
        $response = mysqli_fetch_assoc($result);
        var_dump($response);
        $id=$response['_id'];
        $amenities = $response['AMENITIES'];
        $url = $response['URL'];
        $address = $response['ADDRESS'];
    }

    if(isset($_POST['update-btn'])) {
        $id = $_POST['id'];
        $amenities = mysqli_real_escape_string($connect, $_POST['amenities']);
        $url = mysqli_real_escape_string($connect, $_POST['url']);
        $address = mysqli_real_escape_string($connect, $_POST['address']);

        $query = "UPDATE parks_and_recreation_facilities___4326 SET AMENITIES = '$amenities', URL = '$url', ADDRESS = '$address' WHERE _id = $id";
        $result = mysqli_query($connect, $query);
        header('Location: /assignment2/index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Update Park</title>
</head>
<body>
    <?php include('reusable/admin-header.php') ?>
    <main class="container">
        <h1 class="text-success">Update Park</h1>
        <form action="parks-update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="mb-3">
                <label for="amenities" class="form-label">Amenities:</label>
                <input type="text" class="form-control" name="amenities" id="amenities" value="<?php echo $amenities ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?>">
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" id="url" name="url" value="<?php echo $url; ?>" >
            </div>
            <button type="submit" name="update-btn" class="btn btn-success">Submit</button>
        </form>
    </main>
    
</body>
</html>