<?php include "reusable/connect.php"; ?>

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
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Amenities:</label>
                <input type="text" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="password" class="form-control" id="address">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">URL:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </main>
    
</body>
</html>