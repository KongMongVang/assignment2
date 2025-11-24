<?php require_once "reusable/auth.php"; ?>
<?php include "reusable/connect.php"; ?>


<?php
require('reusable/connect.php');

if(isset($_GET['delete-park'])) {
    $id = $_GET['id'];

    $query = 'DELETE FROM parks_and_recreation_facilities___4326 WHERE _id='. $id;
    $executedQuery = mysqli_query($connect, $query);

    if($executedQuery) {
        header('Location:../index.php');
    } else {
        echo "Could not find park";
    }
}