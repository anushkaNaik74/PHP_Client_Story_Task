<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");
if (!$con) {
    die('error in con' . mysqli_error($con));
}

$id = $_GET['id'];



$delete_client_story = "DELETE FROM pr_client_story WHERE pr_cs_id = $id";

if (mysqli_query($con, $delete_client_story)) {
    echo '<script>alert("Client Story Deleted Successfully");</script>';
    header('location: insert_client_story.php');
} else {
    echo mysqli_error($con);
}
?>
