<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");

if (!$con) {
    die('error in db' . mysqli_error($con));
}

// Variables to store form data
$cs_id = $cs_client = $cs_name = $cs_desc = $cs_status = '';

// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_query = "SELECT * FROM pr_client_story WHERE pr_cs_id = $id";

    $check_query_sql    = mysqli_query($con, $check_query);
    $count_check_query  = mysqli_num_rows($check_query_sql);

    if ($count_check_query > 0) {
        $row            = $check_query_sql->fetch_assoc();
        $cs_id          = $row['pr_cs_id'];
        $cs_client      = $row['pr_cs_client'];
        $cs_name        = $row['pr_cs_name'];
        $cs_desc        = $row['pr_cs_desc'];
        $cs_status      = $row['pr_cs_status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form fields
    $cs_client      = isset($_POST['cs_client']) ? $_POST['cs_client'] : '';
    $cs_name        = isset($_POST['cs_name']) ? $_POST['cs_name'] : '';
    $cs_desc        = isset($_POST['pr_cs_desc']) ? $_POST['pr_cs_desc'] : '';
    $cs_status      = isset($_POST['cs_status']) ? $_POST['cs_status'] : '';

    // Update data in the database
    $update_client_story_query = "UPDATE pr_client_story SET 
                                pr_cs_client    = '$cs_client', 
                                pr_cs_name      = '$cs_name', 
                                pr_cs_desc      = '$cs_desc', 
                                pr_cs_status    = '$cs_status'
                                
                            WHERE pr_cs_id = '$cs_id'";

    
    if (mysqli_query($con, $update_client_story_query)) {
        echo'<script>alert("Client Story Updated Successfully");</script>';
        header('location: insert_client_story.php');
    } else {
        echo "Error: " . $update_client_story_query . "<br>" . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Story</title>
    <link rel="stylesheet" href="../Styles/insert_client_story.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <div class="wrapper">
            <input type="hidden" name="cs_id" value="<?php echo $cd_id; ?>">
            
            <div class="form-row">
                <label for="pr_cs_client">Client</label>
                <input type="number" name="cs_client" id="pr_cs_client" value="<?php echo $cs_client ?>" >
            </div>

            <div class="form-row">
                <label for="pr_cs_name">Name</label>
                <input type="text" name="cs_name" id="pr_cs_name" value="<?php echo $cs_name ?>" >
            </div>

            <div class="form-row">
                <label for="pr_cs_desc">Description</label>
                <textarea type="text" name="pr_cs_desc" id="pr_cs_desc"><?php echo $cs_desc ?></textarea>
            </div>

            <div class="form-row">
                <label for="pr_cs_status">Status</label>
                <input type="number" name="cs_status" id="pr_cs_status" value="<?php echo $cs_status ?>" >
            </div>

            <div class="buttonSubmit">
                <input type="submit" name="update" value="Update">
            </div>
        </div>
    </form>
</body>
</html>
